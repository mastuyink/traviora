<?php

namespace frontend\controllers;

use Yii;
use app\models\TPost;
use app\models\TPostSearch;
use app\models\TDestinasi;
use app\models\TBooking;
use app\models\TCustomer;
use app\models\THariTrip;
use app\models\TLiburTrip;
use app\models\TBiaya;
use app\models\TBiayaKhusus;
use app\models\TSesiBiaya;
use app\models\TLimitDestinasi;
use app\models\TCarrousel;
use app\models\JenisDestinasi;
use app\models\VPostDest;
use app\models\TKurs;
use app\models\TMainCarrousel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\filters\AccessControl;


/**
 * TPostController implements the CRUD actions for TPost model.
 */
class PostingController extends Controller
{
    /**
     * @inheritdoc
     */
   public function behaviors()
    {

        $model                               = TMainCarrousel::find()->all();
        Yii::$app->view->params['carrousel'] = $model ;
        return [
        'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['nature','adventure','login', 'error','home','view','thumb','cari-harga','carrousel'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['update', 'index','create','delete','slug'],
                        'allow' => true,
                       'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

     
    public function actionSlug()
    {
         if (Yii::$app->request->isAjax) {
             $data = Yii::$app->request->post();
             $Dst   = $data['dest'];
             echo strtolower(str_replace(" ", "-", $Dst));

         } else {
            throw new NotFoundHttpException('Cannnot Process Your request');
        }
    }

     public function actionIndex()
    {
      //$this->layout = 'no-tab';  
        $searchModel = new TPostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
           
        ]);
    }

    public function actionCreate()
    {
        // $this->layout  = 'no-tab';
        $model            = new TPost();
        $destinasi        = ArrayHelper::map(VPostDest::find()->where(['id_destinasi'=>null])->all(), 'id', 'nama_destinasi');
        $model->id_author = Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->thumbnail = UploadedFile::getInstance($model, 'thumbnail');
            $model->carrousel = UploadedFile::getInstances($model, 'carrousel');
            $model->save();
            $slug             = $model->slug;
            $id_post          = $model->id;

            if ($model->upload($slug) && $model->carnew($id_post,$slug)) {
                
                  return $this->redirect('index');
               }
            
           
        } else {
            return $this->render('create', [
                'model' => $model,
                'destinasi' => $destinasi
            ]);
        }
    }

      public function actionUpdate($id)
    {
        //$this->layout = 'no-tab';
        $model = $this->findModel($id);
        $destinasi = ArrayHelper::map(TDestinasi::find()->all(), 'id', 'nama_destinasi');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
               $model->thumbnail = UploadedFile::getInstance($model, 'thumbnail');
               $model->carrousel = UploadedFile::getInstances($model, 'carrousel');
               $slug             = $model->slug;
               $id_post          = $id;
          if (!empty($model->thumbnail)) {
            $model->upload($slug);
                 $model->save();
                  return $this->redirect('index');
               
          }

           if (!empty($model->carrousel)) {
                 $model->carup($id_post,$slug);
                 $model->save();
                  return $this->redirect('index');
               }
            $model->save();
             return $this->redirect('index');

        } else {
            return $this->render('update', [
                'model' => $model,
                'destinasi' => $destinasi
            ]);
        }
    }

    public function actionThumb($id)
    {
        $model = $this->findModel($id);
        $response = Yii::$app->getResponse();
        return $response->sendFile($model->gbr_thumbnail,'thumbnail.jpg', [
                //'mimeType' => 'image/jpg',
               //'fileSize' => '386',
                'inline' => true
        ]);
    }

    public function actionCarrousel($id)
    {
        $model = $this->findCar($id);
        $response = Yii::$app->getResponse();
        return $response->sendFile($model->filename, 'Carrousel', [
                'mimeType' => $model->type,
               // 'fileSize' => $model->size,
                'inline' => true
        ]);
    }

    protected function findCar($id){
       if (($model = TCarrousel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Carrousel kosong');
        }
    }

    


    protected function lowerCost($Dest){
        $today = date('Y-m-d');

        $costKhusus = TBiayaKhusus::find()->where(['id_destinasi'=>$Dest])->andWhere(['tgl_event'=>$today])->one();
        $costSeason = TSesiBiaya::find()->where(['id_destinasi'=>$Dest])->andWhere(['id_jenis_sesi'=>1])->one();

        
       if ($costKhusus !== null && $costKhusus->idBiaya->biaya_dewasa < $costSeason->idBiaya->biaya_dewasa) {
            return $costKhusus->idBiaya->biaya_dewasa;
       }elseif ($costSeason !== null) {
           return $costSeason->idBiaya->biaya_dewasa;
       }else{
        return "Biaya belum Di Atur";
       }
    }

    public function actionHome(){
        $this->layout = 'slide';
    $dataProvider = TPost::find()->all();
    $Carrousel = TCarrousel::find()->groupBy('id_post')->all();
        return $this->render('home', [
      
            'dataProvider' => $dataProvider,
            'Carrousel'=>$Carrousel,

        ]);
}

public function actionAdventure(){
        $this->layout = 'slide';
   // $jneisDes = JenisDestinasi::find()->where(['id_jenis_destinasi'=>1])->one();
    $dataProvider = $dataProvider = TPost::find()->joinWith('idDestinasi')->where('t_destinasi.id_jenis_destinasi = :jenisDes',[':jenisDes'=>1])->orderBy(['id'=>SORT_ASC])->all();
    foreach ($dataProvider as $key => $value) {
        
        $lowerCost[$key] = $this->lowerCost($value->id_destinasi);
    }
    $kurs =  $this->kurstab();
        $session['currency'] = 'USD';
    $Carrousel = TCarrousel::find()->groupBy('id_post')->all();
        return $this->render('home', [
      
            'dataProvider' => $dataProvider,
            'Carrousel'=>$Carrousel,
             'lowerCost'=>$lowerCost,
             'kurs'=>$kurs,

        ]);
}

protected function kurstab($currency = 'USD'){
        if (($modelKurs = TKurs::findOne($currency)) !== null) {
            return $modelKurs;
        }else{
             throw new NotFoundHttpException('Error While Processing Your Request');
            
        }
    }

public function actionNature(){
        $this->layout = 'slide';
   // $jneisDes = JenisDestinasi::find()->where(['id_jenis_destinasi'=>1])->one();
    $dataProvider = $dataProvider = TPost::find()->joinWith('idDestinasi')->where('t_destinasi.id_jenis_destinasi = :jenisDes',[':jenisDes'=>2])->orderBy(['id'=>SORT_ASC])->all();
    foreach ($dataProvider as $key => $value) {
        
        $lowerCost[$key] = $this->lowerCost($value->id_destinasi);
    }
    $kurs =  $this->kurstab();
        $session['currency'] = 'USD';
    $Carrousel = TCarrousel::find()->groupBy('id_post')->all();
        return $this->render('home', [
      
            'dataProvider' => $dataProvider,
            'Carrousel'=>$Carrousel,
             'lowerCost'=>$lowerCost,
             'kurs'=>$kurs,

        ]);
}


protected function cariDest($id_dest){

      if (($Destinasi = TDestinasi::findOne($id_dest)) !== null) {
            return $Destinasi;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
}
    /**
     * Displays a single TPost model.
     * @param integer $id
     * @return mixed
     */

    protected function findModelBySlug($slug)
{   

    if (($model = TPost::findOne(['slug' => $slug])) !== null) {
        return $model;
    } else {
        throw new NotFoundHttpException();
    }
}
public function actionView($slug)
{   
        $session      = Yii::$app->session;
        $modelBooking = new TBooking();
        $model        = $this->findModelBySlug($slug);
        $Dest         = $this->cariDest($model->id_destinasi);
        $minpd        = $Dest->min_pax;
        $maxpd        = $Dest->max_pax;
        while ($minpd <= $maxpd) {
                        $Apd[$minpd] = $minpd;
                        $minpd = $minpd+1;
            }

        $listPD    = $Apd;
        $listPab   = ['0'=>'0','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7'];
        $no        = date('d-m-Y H'); 
        $pb        = date('d-m-Y 16');
        
        $Hari      = THariTrip::find()->where(['id_destinasi'=>$model->id_destinasi])->one();
        $senin     = $Hari->id_senin;
        $selasa    = $Hari->id_selasa;
        $rabu      = $Hari->id_rabu;
        $kamis     = $Hari->id_kamis;
        $jumat     = $Hari->id_jumat;
        $sabtu     = $Hari->id_sabtu;
        $minggu    = $Hari->id_minggu;
        
        $LiburDate = TLiburTrip::find()->where(['id_destinasi'=>$model->id_destinasi])->all();
        $rangeDate = TSesiBiaya::find()->where(['id_destinasi'=>$model->id_destinasi])->andWhere(['id_jenis_sesi'=>1])->one();

        if ($no >= $pb) {
        $mx = date('Y-m-d', strtotime('+2 day')); 
        }else{
        $mx = date('Y-m-d', strtotime('+1 day'));
        } 

        if (!empty($LiburDate)) {
            foreach ($LiburDate as $libur) {
        $DisDate[] = $libur->tgl_libur;
            }
        }else{
            $DisDate[]= null;
        }
        
        $Carrousel = TCarrousel::find()->where(['id_post'=>$model->id])->all();
       

    if($modelBooking->load(Yii::$app->request->post())) {
        $modelBooking->pax_request = $modelBooking->dewasa+$modelBooking->anak;
        if($modelBooking->cekStok("pax_request",$model->id_destinasi)){

        try {
            
             $session      = Yii::$app->session;
             $session->open();
            
             if ( $session['booking.pax_request'] != null) {
                 $Dest->stok_seat                = $Dest->stok_seat + $session['booking.pax_request'];
                 $session['booking.pax_request'] = $modelBooking->pax_request;
                 $Dest->stok_seat                = $Dest->stok_seat - $modelBooking->pax_request;
             }else{
                 $session['booking.pax_request'] = $modelBooking->pax_request;
                 $Dest->stok_seat                = $Dest->stok_seat - $modelBooking->pax_request;
             }
             
             $session['destinasi.nama_destinasi']  = $model->idDestinasi->nama_destinasi;
             $Dest->save();
             $session['timeout'] = date('H:i:s', strtotime('+30 minutes'));


           return $this->redirect('/booking/tahap-1');
        } catch (Exception $e) {
           //$session      = session_unset(); 
                
        }
      }
        
    }

        return $this->render('view', [
            'model'        => $model,
            'listPD'       =>$listPD,
            'listPab'      =>$listPab,
            'modelBooking' =>$modelBooking,
            'mx'           =>$mx,
            'senin'        =>$senin,
            'selasa'       =>$selasa,
            'rabu'         =>$rabu,
            'kamis'        =>$kamis,
            'jumat'        =>$jumat,
            'sabtu'        =>$sabtu,
            'minggu'       =>$minggu,
            'DisDate'      =>$DisDate,
            'rangeDate'    =>$rangeDate,
            'Dest'         =>$Dest,
            'Carrousel'    =>$Carrousel,
            //'Booking'     =>$Booking,
            'session'      => $session
        ]);
}


public function actionCariHarga(){
    if (Yii::$app->request->isAjax) {
        $data = Yii::$app->request->post();
        $session =Yii::$app->session;
        $tgl   = $data['tgl'];
        $dest  = $data['dest'];
        $paxd  = $data['paxd'];
        $paxa  = $data['paxa'];
        $paxb  = $data['paxb'];
        $Tpax  = $paxd+$paxa+$paxb;

        if (($Limiter = $this->cekLimit($dest,$tgl,$Tpax)) == true ) {

        $biaya = $this->cari($dest,$tgl);
     /*   if (($connection = $this->checkConnection()) === true) {
        $this->updateKurs();
        }*/
        $modelCurrency = $this->kursTable($session['currency']);
        $priceD   = $biaya->idBiaya->biaya_dewasa * $paxd;
        $priceA   = $biaya->idBiaya->biaya_anak * $paxa;
        $priceB   = $biaya->idBiaya->biaya_bayi * $paxb;
        $paxprice = $priceD+$priceA+$priceB;


         // $session[]

         echo  "<button type='submit' class='btn btn-lg btn-block btn-warning'>BOOK NOW</button>
                  <ul class='list-group'>
                  <li class='list-group-item'>
                    <h4><strong><center id='harga'>".$modelCurrency->id." ".number_format($paxprice/$modelCurrency->round_kurs,2)."</center></strong></h4>
                    </li>
             </ul>";
         $session                                = Yii::$app->session;
         $session->open();
         $session['booking.total_pax']           = $paxa+$paxb+$paxd;
         $session['booking.tgl_trip']            = $tgl;
         $session['booking.dewasa']              = $paxd;
         $session['booking.anak']                = $paxa;
         $session['booking.bayi']                = $paxb;
         $session['destinasi.id_destinasi']      = $dest;
         //$session['destinasi.jenis_destinasi'] = $dest
        // $session['destinasi.nama_destinasi']    = $Limiter->idDestinasi->nama_destinasi;
         $session['booking.biaya_dewasa'] = number_format($priceD/$modelCurrency->round_kurs,2);
         $session['booking.biaya_anak']   = number_format($priceA/$modelCurrency->round_kurs,2);
         $session['booking.biaya_bayi']   = number_format($priceB/$modelCurrency->round_kurs,2);
         $session['currency.id']        = $modelCurrency->id;
         $session['currency.round_kurs']        = $modelCurrency->round_kurs;
         $session['booking.biaya_trip']   = number_format($paxprice/$modelCurrency->round_kurs,2);
         
        }else{
          echo "<a  class='btn btn-lg btn-block btn-danger'>Seat Not Enough</a>
          <li class='list-group-item'>
                    <h4><strong><p id='harga'></p></strong></h4>
                    </li>
             </ul>";
        }

        


    }
}

protected function cekLimit($dest,$tgl,$Tpax){
    $Booking = TBooking::find()->where(['id_destinasi'=>$dest])->andWhere(['tgl_trip'=>$tgl])->sum('total_pax');
  $TBooking = $Booking+$Tpax; 

  if(($CariLimit = TLimitDestinasi::find()->where(['id_destinasi'=>$dest])->andWhere(['tgl_limit'=>$tgl])->one()) !== null){

    if ($TBooking <= $CariLimit->jumlah_limit) {
        return true;
    }else{
      return false;
    }

  }elseif (($CariLimit = TDestinasi::findOne($dest)) !== null ) {

    if ($TBooking <= $CariLimit->main_limit) {
        return true;
    }else{
      return false;
    }

  }else{
     throw new NotFoundHttpException('Mohon Maaf Permintaan Anda Tidak dapat kami Proses');
  }
}

protected function cari($dest,$tgl){

            $LowSession  = TSesiBiaya::find()->where(['id_destinasi'=>$dest])->andWhere(['id_jenis_sesi'=>1])->one();
            $HighSession = TSesiBiaya::find()->where(['id_destinasi'=>$dest])->andWhere(['id_jenis_sesi'=>2])->one();
            $PeakSession = TSesiBiaya::find()->where(['id_destinasi'=>$dest])->andWhere(['id_jenis_sesi'=>3])->one();
            
            $Lowstart    = $LowSession->tgl_mulai;
            $Lowend      = $LowSession->tgl_selesai;

            while (strtotime($Lowstart) <= strtotime($Lowend)) {
                       // echo $Lowstart."<BR>";
                        $tglLow[] = $Lowstart;
                        $Lowstart = date ("Y-m-d", strtotime("+1 day", strtotime($Lowstart)));
            }

            $Highstart = $HighSession->tgl_mulai;
            $Highend = $HighSession->tgl_selesai;

            while (strtotime($Highstart) <= strtotime($Highend)) {
                       // echo $Highstart."<BR>";
                        $tglHigh[] = $Highstart;
                        $Highstart = date ("Y-m-d", strtotime("+1 day", strtotime($Highstart)));
            }

            $Peakstart = $PeakSession->tgl_mulai;
            $Peakend = $PeakSession->tgl_selesai;

            while (strtotime($Peakstart) <= strtotime($Peakend)) {
                       // echo $Peakstart."<BR>";
                        $tglPeak[] = $Peakstart;
                        $Peakstart = date ("Y-m-d", strtotime("+1 day", strtotime($Peakstart)));
            }



            if (in_array($tgl, $tglLow)){
                $low  = true;
                $high = false;
                $peak = false;
            }elseif (in_array($tgl, $tglHigh)) {
                $low  = false;
                $high = true;
                $peak = false;
            }elseif (in_array($tgl, $tglPeak)) {
                $low  = false;
                $high = false;
                $peak = true;
            }


    if (($Event = TBiayaKhusus::find()->where(['id_destinasi'=>$dest])->andWhere(['tgl_event'=>$tgl])->one()) !== null) {
            return $Event;
        }elseif ($low == true) {
            return $LowSession; 
        }elseif ($high == true) {
            return $HighSession; 
        }elseif ($peak == true) {
            return $PeakSession; 
        }
}
   
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    protected function kursTable($currency){
        if (($modelKurs = TKurs::findOne($currency)) !== null) {
            return $modelKurs;
        }else{
             throw new NotFoundHttpException('Error While Processing Your Request');
            
        }
    }


protected function checkConnection(){
        $connected = @fsockopen("www.google.com", 80); 
                                        //website, port  (try 80 or 443)
    if ($connected){
        $is_conn = true; //action when connected
        fclose($connected);
    }else{
        $is_conn = false; //action in connection failure
    }
    return $is_conn;
}

    protected function updateKurs(){
        $modelKurs = TKurs::find()->all();
        $now = date('Y-m-d H:i:s');

        $update_at = date($modelKurs[0]->update_at);
        $expKurs = strtotime ( '+30 minute' , strtotime ( $update_at ) ) ;
        $expKurs = date ('Y-m-d H:i:s' , $expKurs );
     //   $update_at = strtotime('+1 minute',);

        if ( $expKurs < $now) {
           
                foreach ($modelKurs as $value) {
                 $get    = file_get_contents("https://www.google.com/finance/converter?a=1&from=".$value->id."&to=IDR");
                 $get    = explode("<span class=bld>",$get);
                 $get    = explode("</span>",$get[1]);  
                 $kurs_asli  = preg_replace("/[^0-9\.]/", null, $get[0]);  
                 $kurs_round = round($kurs_asli,0,PHP_ROUND_HALF_UP); // 044 ke bawah ... 0.5 ke atas s
                 $value->round_kurs = $kurs_round;
                 $value->update_at = date('Y-m-d H:i:s');
                 $value->save();
            }
            
            
        }
        
                 
    }

    protected function findModel($id)
    {
        if (($model = TPost::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
