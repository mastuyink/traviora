<?php

namespace backend\controllers;

use Yii;
use app\models\TPost;
use app\models\TPostSearch;
use app\models\TDestinasi;
use app\models\TBooking;
use app\models\TCustomer;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * TPostController implements the CRUD actions for TPost model.
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

      

    public function actionHome(){
        // $this->layout = 'no-tab';
    $dataProvider = TPost::find()->all();

        return $this->render('home', [
      
            'dataProvider' => $dataProvider,

        ]);
}

    /**
     * Lists all TPost models.
     * @return mixed
     */
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

    /**
     * Displays a single TPost model.
     * @param integer $id
     * @return mixed
     */
public function actionView($id)
{
     //$this->layout = 'no-tab';
        $session      = Yii::$app->session;
        $session      = session_unset();
        $modelBooking = new TBooking();
        $model        = $this->findModel($id);
        $listPD       = ['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7'];
        $listPab      = ['0'=>'0','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7'];
        $no           = date('d-m-Y H'); 
        $pb           = date('d-m-Y 16');
        //echo date('d-m-Y H:i:s'); 

        if ($no >= $pb) {
        $mx = date('Y-m-d', strtotime('+2 day')); 
        }else{
        $mx = date('Y-m-d', strtotime('+1 day'));
        } 
       

    if($modelBooking->load(Yii::$app->request->post()))
         {

            
            //$total_trip                = $BiayaD+$BiayaA+$BiayaB;

           // $modelBooking->biaya_trip  = $total_trip;
            //$modelBooking->total_biaya = $total_trip;
            //$modelBooking->validate();
       // $modelBooking->save(false);
        try {
                
           
             $BiayaD                               = $modelBooking->dewasa*$model->idDestinasi->harga_dewasa;
             $BiayaA                               = $modelBooking->anak*$model->idDestinasi->harga_anak;
             $BiayaB                               = $modelBooking->bayi*$model->idDestinasi->harga_bayi;
             /*$modelBooking->total_pax            = $modelBooking->dewasa+$modelBooking->anak+$modelBooking->bayi;
             $modelBooking->biaya_trip             = $total_trip;
             $modelBooking->total_biaya            = $total_trip;
             $modelBooking->id_destinasi           = $model->id;*/
             
             //  $modelBooking->id                 = $modelBooking->generateBookingNumber("id");
             $session                              = Yii::$app->session;
             $session->open();
             $session['destinasi.id_destinasi']    = $model->idDestinasi->id;
             $session['destinasi.jenis_destinasi'] = $model->idDestinasi->idJenisDestinasi->jenis_destinasi;
             $session['destinasi.nama_destinasi']  = $model->idDestinasi->nama_destinasi;
             //$session['destinasi.harga_dewasa']    = $model->harga_dewasa;
            // $session['destinasi.harga_anak']      = $model->harga_bayi;
            // $session['booking.code']              = $modelBooking->generateBookingNumber("id");
             $session['booking.total_pax']         = $modelBooking->dewasa+$modelBooking->anak+$modelBooking->bayi;
             $session['booking.tgl_trip']          = $modelBooking->tgl_trip;
             $session['booking.id_destinasi']      = $model->idDestinasi->id;
             $session['booking.biaya_trip']        = $BiayaD+$BiayaA+$BiayaB;
             // $session['booking.total_biaya']    = $total_trip;
             
             $session['booking.dewasa']            = $modelBooking->dewasa;
             $session['booking.anak']              = $modelBooking->anak;
             $session['booking.bayi']              = $modelBooking->bayi;
             $session['booking.biaya_dewasa']      = $model->idDestinasi->harga_dewasa * $modelBooking->dewasa;
             $session['booking.biaya_anak']        = $model->idDestinasi->harga_anak * $modelBooking->anak;
             $session['booking.biaya_bayi']        = $model->idDestinasi->harga_bayi * $modelBooking->bayi;

        
         //$session->destroy();
        // $session['code']                 = $modelBooking->id;

           return $this->redirect('/booking/tahap-1');
        } catch (Exception $e) {
           $session      = session_unset(); 
                
        }
          //  }
    }

        return $this->render('view', [
            'model'        => $model,
            'listPD'        =>$listPD,
            'listPab'      =>$listPab,
            'modelBooking' =>$modelBooking,
            'mx'           =>$mx,
            'session'=> $session
        ]);
}

    public function actionHarga()
{
  if (Yii::$app->request->isAjax) {
        $data      = Yii::$app->request->post();
        //data: { 'save_id' : fileid },
        $dest = $data['dest'];
        $paxd =  $data['paxd'];
        $paxa =  $data['paxa'];
        $paxb =  $data['paxb'];
        
        $Destinasi = TDestinasi::find()->where(['id'=>$dest])->one();
        
        $priceD = $Destinasi->harga_dewasa * $paxd;
        $priceA = $Destinasi->harga_anak * $paxa;
        $priceB = $Destinasi->harga_bayi * $paxb;

        $paxprice = $priceD+$priceA+$priceB;

          echo " Rp ".$paxprice."";
  }
}

    /**
     * Creates a new TPost model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // $this->layout = 'no-tab';
        $model = new TPost();
 $destinasi = ArrayHelper::map(TDestinasi::find()->all(), 'id', 'nama_destinasi');
 $model->id_author = 1;  //Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'destinasi' => $destinasi
            ]);
        }
    }

    /**
     * Updates an existing TPost model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
       //  $this->layout = 'no-tab';
        $model = $this->findModel($id);
        $destinasi = ArrayHelper::map(TDestinasi::find()->all(), 'id', 'nama_destinasi');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'destinasi' => $destinasi
            ]);
        }
    }

    /**
     * Deletes an existing TPost model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TPost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TPost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TPost::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
