<?php

namespace backend\controllers;

use Yii;
use app\models\TBooking;
use app\models\TBookingSearch;
use app\models\TTraveler;
use app\models\TCustomer;
use app\models\TJemput;
use app\models\TAntar;
use app\models\TLokasiAj;
use app\models\TPembayaran;
use app\models\TStatusOrder;
use app\models\TDestinasi;
use app\models\TMetodePembayaran;
use app\models\VValidasiPembayaran;
use \yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;


/**
 * Bookingontroller implements the CRUD actions for TBooking model.
 */
class BookingController extends Controller
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
                    'bulk' => ['POST'],
                ],
            ],
        ];
    }

    public function actionRemindSupplier(){
      if (Yii::$app->request->isAjax) {
        $data =(array)Yii::$app->request->post('idb');
        if (!empty($data)) {
          foreach ($data as $id ) {
            $this->mailSupplier($id);
          }
        }else{
         // / return $this->refresh();
         return $this->redirect('index');
        }
        
      }
    }

    protected function mailSupplier($id){
            $modelBooking   = $this->findModel($id);
            $modelCustomer  = TCustomer::findOne($modelBooking->id_customer);
            $TravelerDewasa = TTraveler::find()->where(['id_leader'=>$modelCustomer])->andWhere(['id_jenis_anggota'=>1])->all();
            $TravelerAnak   = TTraveler::find()->where(['id_leader'=>$modelCustomer])->andWhere(['id_jenis_anggota'=>2])->all();
            $TravelerBayi   = TTraveler::find()->where(['id_leader'=>$modelCustomer])->andWhere(['id_jenis_anggota'=>3])->all();
            $modelJemput    = TJemput::findOne(['id_booking'=>$modelBooking->id]);
            $modelAntar     = TAntar::findOne(['id_booking'=>$modelBooking->id]);

            //to supplier
            $message = 'Message Remind Booking Supplier Traviora';
            Yii::$app->mailReservation->compose()
            ->setFrom('reservation@traviora.com')
            ->setTo($modelBooking->idDestinasi->idSupplier->email)
            ->setSubject('Remind Booking Supplier Traviora')
            ->setHtmlBody($this->renderAjax('/validasi-pembayaran/email-supplier',[
                'modelBooking'   =>$modelBooking,
                'modelCustomer'  =>$modelCustomer,
                'TravelerDewasa' =>$TravelerDewasa,
                'TravelerAnak'   =>$TravelerAnak,
                'TravelerBayi'   =>$TravelerBayi,
                'modelJemput'    =>$modelJemput,
                'modelAntar'     =>$modelAntar,
                'message'       =>$message
                ]))
            ->send();
    }

public function actionBulk(){
  if (Yii::$app->request->isPost) {
    $action=Yii::$app->request->post('status');
    $selection= (array)Yii::$app->request->post('selection');//id gridview checked
   if (empty($selection)) {
     return $this->redirect('index');
   }else{
    foreach($selection as $id){
        $modelBooking            =$this->findModel($id);
        $modelBooking->id_status = $action;
        $modelBooking->save(false);
    }
    return $this->redirect('index');
  }
  }
    
}
 
 public function actionCheckUpdate(){
  if (Yii::$app->request->isAjax) {
      $session       = Yii::$app->session;
      $data=Yii::$app->request->post();
      $idbook = $data['blk'];
      $status = $data['status'];
      foreach($idbook as $id){
        $modelBooking            =$this->findModel($id);
        $modelBooking->id_status = $status;
        $modelBooking->save(false);
    }
  }else{
    $this->redirect('index');
  }
 }
public function actionTahap1()
    {

        $session       = Yii::$app->session;
        //$session->open();
       // $session      = session_unset();
       // $session->destroy();
     //   $session->open();
       // $modelBooking  = TBooking::findOne($session['code']);
       // $modelTraveler = new TTraveler();
        $modelCustomer = new TCustomer();
        $session       = Yii::$app->session;
        $anak          = $session['booking.anak'];
        $dewasa        = $session['booking.dewasa'];
        $bayi          = $session['booking.bayi'];

   // $count = count($dewasa);
    $modelTraveler = [new TTraveler()];
    for($i = 1; $i < $dewasa; $i++) {
        $modelTraveler[] = new TTraveler();

    }

    $TravelerAnak = [$dewasa => new TTraveler()];
    for($i = 1; $i < $anak; $i++) {
        $TravelerAnak[] = new TTraveler();

    }

    $Travelerbayi = [$dewasa+$anak => new TTraveler()];
    for($i = 1; $i < $bayi; $i++) {
        $Travelerbayi[] = new TTraveler();

    }

if ($modelCustomer->load(Yii::$app->request->post()) && Model::loadMultiple($modelTraveler, Yii::$app->request->post()) && $modelCustomer->validate() && Model::validateMultiple($modelTraveler)/* && Model::loadMultiple($TravelerAnak, Yii::$app->request->post()) && Model::loadMultiple($Travelerbayi, Yii::$app->request->post())*/ ) {
  $session->open();
        //for customer / leader
        $session['customer.nama_customer'] = $modelCustomer->nama_customer;
        $session['customer.telp']          = $modelCustomer->no_telp;
        $session['customer.email']         = $modelCustomer->email;

        //Traveler Dewasa
       //  $nama_customer = $session['traveler.nama_traveler'];

             foreach ($modelTraveler as $traveler) {
        $nama_dewasa[] = $traveler->nama;
            }
        $session['traveler.nama_traveler'] = $nama_dewasa;
        $session['traveler.jml_dewasa'] = count($nama_dewasa);


        //Traveler Anak
       // $traveler_anak = $session['traveler.nama_anak'];
        if (!empty(Model::loadMultiple($TravelerAnak, Yii::$app->request->post())) && Model::validateMultiple($TravelerAnak)) {
           foreach ($TravelerAnak as $traveler) {
        $traveler_anak[] = $traveler->nama;
            }
        $session['traveler.nama_anak'] = $traveler_anak;
        $session['traveler.jml_anak'] = count($traveler_anak);
        }

    if (!empty(Model::loadMultiple($Travelerbayi, Yii::$app->request->post())) && Model::validateMultiple($Travelerbayi)) {
        foreach ($Travelerbayi as $bayi) {
        $traveler_bayi[] = $bayi->nama;
            }
        $session['traveler.nama_bayi'] = $traveler_bayi;
        $session['traveler.jml_bayi'] = count($traveler_bayi);
        }
        //Traveler Bayi

        //$session->close();
        //for traveler / anggota
       // $session['traveler.nama_traveler'] = $modelTraveler->nama;
        //$session['traveler']
        return $this->redirect('tahap-2');
    }else{
        return $this->render('tahap-1', [
        //'modelBooking' => $modelBooking,
        'anak'=>$anak,
        'dewasa'=>$dewasa,
        'bayi'=>$bayi,
        'modelTraveler'=>$modelTraveler,
        'TravelerAnak'=>$TravelerAnak,
        'Travelerbayi'=>$Travelerbayi,
        'modelCustomer'=>$modelCustomer,
       // 'sessionH'=> $sessionH,
        'session'=> $session,



                ]);
         }
    }


    public function actionArea($id_lokasi){
         $countPosts = TAreaAj::find()->where(['id_lokasi_aj' => $id_lokasi])->count();
         $posts = TAreaAj::find()->where('id != :id',[':id' => 0])->andwhere(['id_lokasi_aj' => $id_lokasi])->orderBy('nama_area ASC')->all();
         if($countPosts>0){
            echo "<option value=''> Pilih lokasi </option>";
         foreach($posts as $post){
         echo "<option value='".$post->id."'>".$post->nama_area."</option>";
         }

         }else{
         echo "<option> -> empty <-</option>";
         }

     }

     //PENGHITUNGAN BIAYA



protected function cariTime($id_destinasi,$id_lokasi){
    if(($Area = WaktuJemput::find()->where(['id_destinasi'=>$id_destinasi])->andWhere(['id_lokasi_aj'=>$id_lokasi])->one()) !== null){
        return $Area;
    }else{
        return null;
    }
}

public function actionPickupTime(){
if (Yii::$app->request->isAjax) {
        $data         =  Yii::$app->request->post();
        $session      = Yii::$app->session;
        $id_lokasi    =  $data['idl'];
        $id_destinasi = $session['destinasi.id_destinasi'];
        $session->open();
        if (($waktu_jemput  = $this->cariTime($id_destinasi,$id_lokasi)) !== null) {

            $session['jemput.id_jam_jemput'] = $waktu_jemput->id;

        echo "<h7>Waktu penjemputan Antara Pukul  <strong>".date('G:i',strtotime($waktu_jemput->start_time))." - ".date('G:i',strtotime($waktu_jemput->end_time))."</strong> </h7>";
        }else{

        $session['jemput.id_jam_jemput'] = $waktu_jemput;

        echo "<h7> Location not Found in Map </h7>";
        }

}
}


protected function cariTarif($id_lokasi,$id_area){
   $session      = Yii::$app->session;
    //$session->open();
    $id_destinasi =$session['destinasi.id_destinasi'];
    if(($Dual = TarifAj::find()->where(['id_destinasi'=>$id_destinasi])->andwhere(['id_lokasi'=>$id_lokasi])->andWhere(['id_area'=>$id_area])->andWhere(['id_jenis_tarif'=>1])->one()) !== null){
        return $Dual;
    }elseif(($Sharing = TarifAj::find()->where(['id_destinasi'=>$id_destinasi])->andwhere(['id_lokasi'=>$id_lokasi])->andWhere(['id_area'=>$id_area])->andWhere(['id_jenis_tarif'=>2])->one()) !== null){
        return $Sharing;
    }elseif(($Private = TarifAj::find()->where(['id_destinasi'=>$id_destinasi])->andwhere(['id_lokasi'=>$id_lokasi])->andWhere(['id_area'=>$id_area])->andWhere(['id_jenis_tarif'=>3])->one()) !== null){
        return $Private;
    }else{
        return null;
    }
}

public function actionExtraPickup(){
        if (Yii::$app->request->isAjax) {
            $data      =  Yii::$app->request->post();
            $id_area   =  $data['ida'];
            $id_lokasi =  $data['idl'];
            $session   = Yii::$app->session;
            $session->open();
            $Tarif     = $this->cariTarif($id_lokasi,$id_area);
            if ($Tarif == null ) {
            echo "Biaya Dan Metode Penjemputan Akan Diinfokan Selanjutnya Oleh Cs";
            $session['jemput.biaya'] = 0;
            $session['jemput.metode'] = null;
            }elseif ($Tarif->id_jenis_tarif == 1 ) {
                echo "<div id='rad-pick' class='form-group field-radio-metode required has-success'>
                    <label class='control-label'>Metode Penjemputan</label>
                      <input name='TJemput[id_metode_jemput]' value='' type='hidden'>
                        <div id='radio-metode' inline='' onchange='
                              var mtdn = $(&quot;#rad-pick :radio:checked&quot;).val();
                              $.ajax({
                               url : &quot;/booking/dual-mode&quot;,
                               type: &quot;POST&quot;,
                               data: {metr: mtdn},
                               success: function (div) {
                               $(&quot;#cost-pick&quot;).html(div);
                               },
                               })' aria-required='true' aria-invalid='false'>
                      <label><input name='TJemput[id_metode_jemput]' value='2' type='radio' checked='checked'> Sharing</label>
                      <label><input name='TJemput[id_metode_jemput]' value='3' type='radio'> Private</label></div>

                <div class='help-block'></div>
                </div>
                <h5 id='cost-pick'>Biaya <strong>Rp ".number_format($Tarif->tarif_pax,0)." </strong>/ Pax</h5>";
            //echo "Dual Mode";
        $session['jemput.tarif_pax'] = $Tarif->tarif_pax;
        $session['jemput.tarif_car'] = $Tarif->tarif_car;
        $session['jemput.biaya'] = $Tarif->tarif_pax;
        //$session['jemput.biaya']  = $Tarif->biaya;
        //echo "<h4>Biaya / Car  Rp ".number_format($Tarif->tarif_car,0)." </h4>
        //<h4>Biaya / Car  Rp ".number_format($Tarif->tarif_pax,0)." </h4>";
        }elseif ($Tarif->id_jenis_tarif == 2 ) {
            echo "Metode Penjemputan Sharing<br>Biaya <strong>Rp ".number_format($Tarif->tarif_pax,0)." </strong>/ Pax";
            $session['jemput.biaya'] = $Tarif->tarif_pax;
            $session['jemput.metode'] = 2;
        }elseif ($Tarif->id_jenis_tarif == 3 ) {
            echo "Metode Penjemputan Private<br>Biaya <strong>Rp ".number_format($Tarif->tarif_car,0)." </strong>/ Car";
            $session['jemput.biaya'] = $Tarif->tarif_car;
            $session['jemput.metode'] = 3;
        }else{

       // $session['jemput.biaya']  = "Kodong";
       echo "<h4>Something Is Wrong, Please Contact Cs</h4>";
       $session['jemput.biaya'] = null;
        }

    }
}

public function actionDualMode(){
if (Yii::$app->request->isAjax) {
        $data      =  Yii::$app->request->post();
        $metode    = $data['metr'];
        $session   = Yii::$app->session;
        if ($metode == 2 ) {
            echo "Biaya <strong>Rp ".number_format($session['jemput.tarif_pax'],0)." </strong>/ Pax" ;
            $session['jemput.biaya'] = $session['jemput.tarif_pax'];
            $session['jemput.metode'] = 2;
        }elseif ($metode == 3) {
            echo "Biaya <strong>Rp ".number_format($session['jemput.tarif_car'],0)." </strong>/ Car" ;
            $session['jemput.biaya'] = $session['jemput.tarif_car'];
            $session['jemput.metode'] = 3;
        }else{
            echo "Something Is Wrong";
            $session['jemput.biaya'] = 0;
            $session['jemput.metode'] = null;
        }
}
}

public function actionExtraDrop(){
if (Yii::$app->request->isAjax) {
        $data      =  Yii::$app->request->post();
        $id_area   =  $data['ida'];
        $id_lokasi =  $data['idl'];
        $session   = Yii::$app->session;
        $session->open();
        $Tarif     = $this->cariTarif($id_lokasi,$id_area);
        if ($Tarif == null ) {
            echo "Biaya Dan Metode Penjemputan Akan Diinfokan Selanjutnya Oleh Cs";
            $session['antar.biaya'] = null;
            $session['antar.metode'] = null;

        }elseif ($Tarif->id_jenis_tarif == 1 ) {
        echo "<div id='rad-drop' class='form-group field-radio-metode required has-success'>
        <label class='control-label'>Metode Pengantaran</label>
        <input name='TAntar[id_metode_antar]' value='' type='hidden'><div id='radio-metode' inline='' onchange='
                              var mtdx = $(&quot;#rad-drop :radio:checked&quot;).val();
                               $.ajax({
                               url : &quot;/booking/dual-model&quot;,
                               type: &quot;POST&quot;,
                               data: {metz: mtdx},
                               success: function (div) {
                               $(&quot;#cost-drop&quot;).html(div);
                               },
                               })' aria-required='true' aria-invalid='false'><label><input name='TAntar[id_metode_antar]' value='2' type='radio' checked='checked'> Sharing</label>
        <label><input name='TAntar[id_metode_antar]' value='3' type='radio'> Private</label></div>

        <div class='help-block'></div>
        </div><h5 id='cost-drop'>Biaya <strong>Rp ".number_format($Tarif->tarif_pax,0)." </strong>/ Pax</h5>";
            //echo "Dual Mode";
        $session['antar.tarif_pax'] = $Tarif->tarif_pax;
        $session['antar.tarif_car'] = $Tarif->tarif_car;
        $session['antar.biaya']     = $Tarif->tarif_pax;
        //$session['jemput.biaya']  = $Tarif->biaya;
        //echo "<h4>Biaya / Car  Rp ".number_format($Tarif->tarif_car,0)." </h4>
        //<h4>Biaya / Car  Rp ".number_format($Tarif->tarif_pax,0)." </h4>";
        }elseif ($Tarif->id_jenis_tarif == 2 ) {
            echo "Metode Drop-Off Sharing<br>Biaya <strong>Rp ".number_format($Tarif->tarif_pax,0)." </strong>/ Pax";
            $session['antar.biaya'] = $Tarif->tarif_pax;
            $session['antar.metode'] = 2;
        }elseif ($Tarif->id_jenis_tarif == 3 ) {
            //echo "Private Mode";
            echo "Metode Drop-Off Private<br>Biaya <strong>Rp ".number_format($Tarif->tarif_car,0)." </strong>/ Car";
            $session['antar.biaya'] = $Tarif->tarif_car;
            $session['antar.metode'] = 3;
        }else{

       // $session['jemput.biaya']  = "Kodong";
        echo "<h4>Something Is Wrong, Please Contact Cs</h4>";
        $session['antar.biaya'] = null;
        $session['antar.metode'] = null;
        }
}
}


    protected function cariArea($idArea){
    if(($Area = TAreaAj::findOne($idArea)) !== null){
        return $Area;
    }else{
        return null;
    }
    }

public function actionDualModel(){
if (Yii::$app->request->isAjax) {
        $data  =  Yii::$app->request->post();
        $metod = $data['metz'];
        $session   = Yii::$app->session;
        if ($metod == 2 ) {
            echo "Biaya <strong>Rp ".number_format($session['antar.tarif_pax'],0)." </strong>/ Pax" ;
            $session['antar.biaya'] = $session['antar.tarif_pax'];
            $session['antar.metode'] = 2;
        }elseif ($metod == 3) {
            echo "Biaya <strong>Rp ".number_format($session['antar.tarif_car'],0)." </strong>/ Car" ;
            $session['antar.biaya'] = $session['antar.tarif_car'];
            $session['antar.metode'] = 3;
        }else{
            echo "Something Is Wrong";
            $session['antar.metode'] = null;
        }
}
}

     //PICKUP AND DROP OFF
    public function actionTahap2()
    {
         $session   = Yii::$app->session;

        $modelAntar  = new TAntar();
        $modeljemput = new TJemput();
        $listAJ      = ArrayHelper::map(TLokasiAj::find()->all(), 'id', 'lokasi_aj');
        $areaAJ      = ArrayHelper::map(TAreaAj::find()->all(), 'id', 'nama_area');
if ($modeljemput->load(Yii::$app->request->post()) && $modelAntar->load(Yii::$app->request->post())) {
        //for Jemput

  if ($modeljemput->lokasi_jemput !== "1" && $modelAntar->lokasi_antar !== "1" ) {

         try{
        // $transaction = Yii::$app->db->beginTransaction();
           $session  = Yii::$app->session;
            $saveArea2  = new TAreaAj();
            $idArea2 = $modeljemput->nama_area;
             if (($areajemput  = $this->cariArea($idArea2)) == null) {
              $saveArea2->load(Yii::$app->request->post());
              $saveArea2->id_lokasi_aj        = $modeljemput->lokasi_jemput;
              $saveArea2->nama_area           = $modeljemput->nama_area;
              $saveArea2->save(false);
              $session['jemput.id_area_jemput'] = $saveArea2->id;
              }else{
              $session['jemput.id_area_jemput'] = $idArea2;
              }

           $saveArea  = new TAreaAj();
           $idArea = $modelAntar->nama_area;
            if (($areaAntar  = $this->cariArea($idArea)) == null) {
                $saveArea->load(Yii::$app->request->post());
              $saveArea->id_lokasi_aj           = $modelAntar->lokasi_antar;
              $saveArea->nama_area              = $modelAntar->nama_area;
              $saveArea->save(false);
              $session['antar.id_area_antar'] = $saveArea->id;
              }else{
              $session['antar.id_area_antar'] = $idArea;
            }


           // $transaction->commit();
                //$session['jemput.id_booking']     = $session['booking.code'];

                $session['jemput.id_lokasi_jemput'] = $modeljemput->lokasi_jemput;
                $session['jemput.id_metode_jemput'] = $modeljemput->id_metode_jemput;
                $session['jemput.alamat_jemput']    = $modeljemput->alamat_jemput;
                $session['jemput.no_telp_jemput']   = $modeljemput->no_telp_jemput;

                //for antar
                // $session['antar.id_booking']   = $modelBooking->id;
                $session['antar.lokasi_antar']    = $modelAntar->lokasi_antar;
                $session['antar.alamat_antar']    = $modelAntar->alamat_antar;
                $session['antar.no_telp_antar']   = $modelAntar->no_telp_antar;
               // $session->close();
                //$session->destroy();

                return $this->redirect('tahap-3');
         }catch (Exception $e) {
        //$transaction->rollback();
          // $session      = session_unset();

            }
  }elseif ($modeljemput->lokasi_jemput == "1" && $modelAntar->lokasi_antar !== "1" ) {
           $session  = Yii::$app->session;
           $saveArea  = new TAreaAj();
           $idArea = $modelAntar->nama_area;
            if (($areaAntar  = $this->cariArea($idArea)) == null) {
                $saveArea->load(Yii::$app->request->post());
              $saveArea->id_lokasi_aj           = $modelAntar->lokasi_antar;
              $saveArea->nama_area              = $modelAntar->nama_area;
              $saveArea->save(false);
              $session['antar.id_area_antar'] = $saveArea->id;
              }else{
              $session['antar.id_area_antar'] = $idArea;
            }
 //for antar
                // $session['antar.id_booking']   = $modelBooking->id;
                $session['antar.lokasi_antar']    = $modelAntar->lokasi_antar;
                $session['antar.alamat_antar']    = $modelAntar->alamat_antar;
                $session['antar.no_telp_antar']   = $modelAntar->no_telp_antar;
               // $session->close();
                //$session->destroy();

                return $this->redirect('tahap-3');
  }elseif ($modeljemput->lokasi_jemput !== "1" && $modelAntar->lokasi_antar == "1" ) {

            $session  = Yii::$app->session;
            $saveArea2  = new TAreaAj();
            $idArea2 = $modeljemput->nama_area;
             if (($areajemput  = $this->cariArea($idArea2)) == null) {
              $saveArea2->load(Yii::$app->request->post());
              $saveArea2->id_lokasi_aj        = $modeljemput->lokasi_jemput;
              $saveArea2->nama_area           = $modeljemput->nama_area;
              $saveArea2->save(false);
              $session['jemput.id_area_jemput'] = $saveArea2->id;
              }else{
              $session['jemput.id_area_jemput'] = $idArea2;
              }
  }elseif ($modeljemput->lokasi_jemput == "1" && $modelAntar->lokasi_antar == "1" ) {
            unset($session['jemput.biaya'],$session['jemput.metode'],$session['jemput.id_jam_jemput'],$session['jemput.id_area_jemput'],$session['antar.biaya'],$session['antar.metode'],$session['antar.id_area_antar']);
             return $this->redirect('tahap-3');
            //unset($session['antar.biaya']);
  }else{
     // $session->destroySession($session['pembayaran.id_metode']);
      $session['jemput.lokasi_jemput']  = $modeljemput->lokasi_jemput;
      $session['antar.lokasi_antar']    = $modelAntar->lokasi_antar;
      $session['jemput.id_area_jemput'] = $modeljemput->nama_area;
      $session['antar.id_area_antar']   = $modelAntar->nama_area;
     return $this->redirect('tahap-3');

      }


    }
        return $this->render('tahap-2', [
        'modelAntar'=>$modelAntar,
        'modeljemput'=>$modeljemput,
        'listAJ'=> $listAJ,
        'areaAJ'=>$areaAJ,
        'session'=>$session
                ]);

    }


    public function actionTahap3()
    {
        $session                           = Yii::$app->session;
       // $session->open();
       // $modelBooking                      = TBooking::findOne($session['code']);
        $modelpembayaran                   = new TPembayaran();
        $metode_bayar                      = ArrayHelper::map(TMetodePembayaran::find()->all(), 'id', 'metode');
        //$modelpembayaran->id_booking       = $modelBooking->id;


if ($modelpembayaran->load(Yii::$app->request->post())) {
    try{
   // $modelpembayaran->token_konfirmasi = $modelpembayaran->generatePaymentToken("token_konfirmasi");
        //$session['pembayaran.token_konfirmasi'] = $modelpembayaran->generatePaymentToken("token_konfirmasi");
        //$session['pembayaran.id_booking']       = $modelBooking->id;
        $session['pembayaran.id_metode']        = $modelpembayaran->id_metode;
        // $session['pembayaran.nama_pengirim'] = $modelpembayaran->nama_pengirim;
        // $session['pembayaran.tgl_kirim']     = $modelpembayaran->tgl_kirim;
        //$session->close();


        return $this->redirect('check-out');
    } catch (Exception $e) {
           //$session      = session_unset();

        }
    }else{
        return $this->render('tahap-3', [
                'modelpembayaran' =>$modelpembayaran,
                'metode_bayar'    =>$metode_bayar,
                'session'         =>$session
                ]);
         }
    }


    public function actionCheckOut()
    {
        $session         = Yii::$app->session;
        $modelBooking    = new TBooking;
        $modelCustomer   = new TCustomer;
        $modelAntar      = new TAntar;
        $modeljemput     = new TJemput;
        $modelpembayaran = new TPembayaran;
        $listAJ          = ArrayHelper::map(TLokasiAj::find()->all(), 'id', 'lokasi_aj');
        $metode_bayar    = ArrayHelper::map(TMetodePembayaran::find()->all(), 'id', 'metode');
        $metode_jemput   = TJenisTarifAj::findOne($session['jemput.metode']);
        $metode_antar    = TJenisTarifAj::findOne($session['antar.metode']);
        $no              = date('d-m-Y H');
        $pb              = date('d-m-Y 16');


        $anak          = $session['booking.anak'];
        $dewasa        = $session['booking.dewasa'];
        $bayi          = $session['booking.bayi'];

        $waktu_jemput = WaktuJemput::findOne($session['jemput.id_jam_jemput']);
        $waktu_antar = WaktuJemput::findOne($session['antar.id_jam_antar']);

        //$session['antar.metode']


        $Areajemput = TAreaAj::findOne($session['jemput.id_area_jemput']);
        $AreaAntar = TAreaAj::findOne($session['antar.id_area_antar']);


   // $count = count($dewasa);
    $TravelerDewasa = [new TTraveler()];
    for($i = 1; $i < $dewasa; $i++) {
        $TravelerDewasa[] = new TTraveler();

    }

    $TravelerAnak = [$dewasa => new TTraveler()];
    for($i = 1; $i < $anak; $i++) {
        $TravelerAnak[] = new TTraveler();

    }

    $Travelerbayi = [$dewasa+$anak => new TTraveler()];
    for($i = 1; $i < $bayi; $i++) {
        $Travelerbayi[] = new TTraveler();

    }
        //echo date('d-m-Y H:i:s');
        if ($no >= $pb) {
        $mx = date('Y-m-d', strtotime('+2 day'));
        }else{
        $mx = date('Y-m-d', strtotime('+1 day'));
        }


    if ($modelCustomer->load(Yii::$app->request->post()) && $modelpembayaran->load(Yii::$app->request->post()) && Model::loadMultiple($TravelerDewasa, Yii::$app->request->post()))
    {


        try{

                    $transaction = Yii::$app->db->beginTransaction();
                    //$modelCustomer->validate();



                   // $modelCustomer->id_booking = $id_booking;
                    $modelCustomer->validate();
                    $modelCustomer->save();
                    $modelBooking->id_destinasi  = $session['destinasi.id_destinasi'];
                    $modelBooking->id_customer   = $modelCustomer->id;
                    $modelBooking->tgl_trip      = date('Y-m-d', strtotime($session['booking.tgl_trip']));
                    $modelBooking->biaya_trip    = $session['booking.biaya_trip'];
                    $modelBooking->total_pax     = $session['booking.total_pax'];
                    $modelBooking->biaya_jemput  = $session['jemput.biaya']+0;
                    $modelBooking->biaya_antar   = $session['antar.biaya']+0;

                    $modelBooking->total_biaya   = $session['booking.biaya_trip'] + $modelBooking->biaya_jemput + $modelBooking->biaya_antar;
                    $now                         = date('Y-m-d 16:i:s');
                    $waktu_exp                   = date('Y-m-d 16:00:00',strtotime($now));
                    $modelBooking->id            = $modelBooking->generateBookingNumber("id");
                    $modelBooking->waktu_exp     = $waktu_exp;
                    $modelBooking->validate();
                    $modelBooking->save();

                    $modeljemput->id_booking     = $modelBooking->id;
                    //Ada Pickup
                    if ($Areajemput !== null) {
                       $modeljemput->id_area_jemput = $Areajemput->id;
                       $modeljemput->alamat_jemput  = $session['jemput.alamat_jemput'];
                       $modeljemput->no_telp_jemput = $session['jemput.no_telp_jemput'];

                      //sharing
                        if ($metode_jemput !== null && $metode_jemput->id == "2") {
                       $modeljemput->id_metode_jemput = "2";
                       $modeljemput->biaya_jemput     =  $session['jemput.biaya'];
                      //private
                        }elseif ($metode_jemput !== null && $metode_jemput->id == "3") {
                        $modeljemput->id_metode_jemput = "3";
                        $modeljemput->biaya_jemput     = $session['jemput.biaya'];
                      //pickup menyusul
                        }else{

                        }
                       $modeljemput->id_jam_jemput = $waktu_jemput->id;
                    // no pickup
                    }else{
                      $modeljemput->id_area_jemput = "0";
                      $modeljemput->biaya_jemput     =  $session['jemput.biaya'];

                       }

                       $modeljemput->save();

                       $modelAntar->id_booking      = $modelBooking->id;
                    if ($AreaAntar !== null) {
                       $modelAntar->id_area_antar = $AreaAntar->id;
                       $modelAntar->alamat_antar  = $session['antar.alamat_antar'];
                       $modelAntar->no_telp_antar = $session['antar.no_telp_antar'];

                      //sharing
                        if ($metode_antar !== null && $metode_antar->id == "2") {
                       $modelAntar->id_metode_antar = "2";
                       $modelAntar->biaya_antar     =  $session['antar.biaya'];
                      //private
                        }elseif ($metode_antar !== null && $metode_antar->id == "3") {
                        $modelAntar->id_metode_antar = "3";
                        $modelAntar->biaya_antar     = $session['antar.biaya'];
                      //pickup menyusul
                        }else{

                        }
                       $modelAntar->id_jam_antar = $session['antar.id_jam_antar'];
                    // no pickup
                    }else{
                      $modelAntar->id_area_antar = "0";
                      $modelAntar->biaya_antar     =  $session['antar.biaya'];

                       }

                    
                    //$modelAntar->validate();
                    $modelAntar->save();


                    //$modelAntar->validate();
                    

                    $modelpembayaran->id_booking = $modelBooking->id;
                    $modelpembayaran->token_konfirmasi = $modelpembayaran->generatePaymentToken("token_konfirmasi");

                    //$modelpembayaran->validate();
                    $modelpembayaran->save();

                    $encryptToken                = Yii::$app->getSecurity()->maskToken($modelpembayaran->token_konfirmasi);

                    //DEWASA

                    foreach ($TravelerDewasa as $dewasa) {
                    $ModelDewasa = new TTraveler();
                    $ModelDewasa->nama = $dewasa->nama;
                    $ModelDewasa->id_leader = $modelCustomer->id;
                    $ModelDewasa->id_jenis_anggota = "1";
                    $ModelDewasa->save(false);

                        }



                   //ANAK
                        if (!empty(Model::loadMultiple($TravelerAnak, Yii::$app->request->post()))) {
                       foreach ($TravelerAnak as $anak) {
                    $ModelAnak = new TTraveler();
                    $ModelAnak->nama = $anak->nama;
                    $ModelAnak->id_leader = $modelCustomer->id;
                    $ModelAnak->id_jenis_anggota = "2";
                    $ModelAnak->save(false);
                        }
                    }

                    //BAYI
                    if (!empty(Model::loadMultiple($Travelerbayi, Yii::$app->request->post()))) {
                    foreach ($Travelerbayi as $bayi) {
                    $Modelbayi = new TTraveler();
                    $Modelbayi->nama = $bayi->nama;
                    $Modelbayi->id_leader = $modelCustomer->id;
                    $Modelbayi->id_jenis_anggota = "3";
                    $Modelbayi->save(false);
                        }
                    }


                    /*$modelCustomer->nama_customer    = $session['customer.nama_customer'];
                    $modelCustomer->no_telp            = $session['customer.telp'];
                    $modelCustomer->email              = $session['customer.email'];
                    $modelCustomer->validate();
                    $modelCustomer->save();

                    $modeljemput->id_booking           = $session['jemput.id_booking'];
                    $modeljemput->id_lokasi_jemput     = $session['jemput.lokasi_jemput'];
                    $modeljemput->alamat_jemput        = $session['jemput.alamat_jemput'];
                    $modeljemput->no_telp_jemput       = $session['jemput.no_telp_jemput'];
                    $modeljemput->validate();
                    $modeljemput->save();

                    $modelAntar->id_booking            = $session['antar.id_booking'];
                    $modelAntar->id_lokasi_antar       = $session['antar.lokasi_antar'];
                    $modelAntar->alamat_antar          = $session['antar.alamat_antar'];
                    $modelAntar->no_telp_antar         = $session['antar.no_telp_antar'];
                    $modelAntar->validate();
                    $modelAntar->save();

                    $modelpembayaran->id_booking       = $session['pembayaran.id_booking'];
                    $modelpembayaran->id_metode        = $session['pembayaran.id_metode'];
                    $modelpembayaran->token_konfirmasi = $session['pembayaran.token_konfirmasi'];
                    $modelpembayaran->validate();
                    $modelpembayaran->save();

                    $transaction->commit();
                    $session->destroy();
                    $session->close();*/
            Yii::$app->mailReservation->compose()
            ->setFrom('reservation@traviora.com')
            ->setTo($modelCustomer->email)
            ->setSubject('E-BILLING ISTANA TRAVEL')
            ->setHtmlBody("
            <center> <img src='https://gallery.mailchimp.com/933bc1035d83ef185bc319a0b/images/f6f9a28c-430e-4f22-bd88-88359af0e3f0.png'> </center>
              <table>

                    <td colspan ='3'>

            <p> Kepada Yth. Sdr/i. ".$modelCustomer->nama_customer.",
                    </td>

                </tr>
                <tr>
                    <td  colspan ='3'>
            Terima kasih atas kepercayaan Anda menggunakan Istana Travel (http://istanatravel.com).

            Kami akan memproses order Anda setelah kami menerima bukti atau pembayaran yang telah Anda lakukan. Jika Sampai Jam 4 Sore Pada H-1 kami tidak menerima bukti atau info pembayaran dari Anda, kami menganggap Anda telah membatalkan order Anda.
                    </td>

                </tr>
                 <tr>
                    <td colspan='3'><center><b><h4>DETAIL ORDER</h4></b></center></td>

                </tr>
                <tr>

                    <td>
                    DESTINASI </td>
                    <td>:</td>
                    <td>".$modelBooking->idDestinasi->nama_destinasi."</td>
                </tr>
                <tr>

                    <td>TANGGAL KEBERANGKATAN </td>
                    <td>:</td>
                    <td>".date('d-m-Y',strtotime($modelBooking->tgl_trip))."</td>
                </tr>
                <tr>

                    <td>Total Biaya </td>
                    <td>:</td>
                    <td> Rp ".$modelBooking->total_biaya."</td>
                </tr>
                <tr>

                    <td>Jumlah pax </td>
                    <td>:</td>
                    <td>".$modelBooking->total_pax."</td>
                </tr>
                <tr>
                <td>
                Harap Lakukan Pembayaran Sebelum <strong>". $modelBooking->waktu_exp ."</strong> Atau Pesanan Anda Akan Dibatalkan
                </td>
                </tr>
                <tr>
                <td>
                Anda dapat melakukan pembayaran ke nomor rekening berikut
               <br> 1. Bank Central Asia (BCA), No Rek. ( 1800464249 ) A.N ( Muhammad Ziaul Haq )
               <br> 2.  Bank Mandiri, No Rek. 1430005599780 A.N ( Muhammad Ziaul Haq )
                <br> 3. Bank Negara Indonesia (BNI), No Rek. 2345678117 A.N ( Muhammad Ziaul Haq )

                </td>
                </tr>
                <tr>
                    <td colspan='3'> Jika Anda Telah Melakukan Pembayaran Silahkan MEngisi Form konfirmasi Pada Link Berikut ini
            <center><a class='btn btn-lg btn-success' href='http://book.travel.com/payment/confirm-payment?token=".$encryptToken."'>LINK KONFIRMASI</a></center>
                    </td>

                </tr>
                <tr>
                    <td colspan='3'>
            Terima kasih atas perhatian dan kepercayaan Anda.
                    </td>

                </tr>
            </table>  ")->send();


                    //$session->unset();
                    //$session = session_unset();
                    $transaction->commit();

                    Yii::$app->getSession()->setFlash(
                                'success','Pemesanan Sukses, Silahkan Periksa Email Anda Untuk Proses Selanjutnya'
                            );

                    return $this->redirect('end-order');
      } catch(Exception $e){
                    $transaction->rollback();
                   // $modelBooking->delete();
                    //$session->destroy();
                    //$session->close();
                    throw $e;
        }
    }else{
        return $this->render('check-out', [
            'modelBooking'    => $modelBooking,
            'modelCustomer'   => $modelCustomer,
            'modelCustomer'   => $modelCustomer,
            'modelAntar'      => $modelAntar,
            'modeljemput'     => $modeljemput,
            'modelpembayaran' => $modelpembayaran,
            'TravelerDewasa'  => $TravelerDewasa,
            'TravelerAnak'    => $TravelerAnak,
            'Travelerbayi'    => $Travelerbayi,
            'listAJ'          => $listAJ,
            'metode_bayar'    => $metode_bayar,
            'session'         => $session,
            'dewasa'          => $dewasa,
            'anak'            => $anak,
            'bayi'            => $bayi,
            'mx'              => $mx,
            'metode_jemput'   =>$metode_jemput,
            'metode_antar'   =>$metode_antar,
            'Areajemput'      =>$Areajemput,
            'waktu_jemput'    =>$waktu_jemput,
            'AreaAntar'       =>$AreaAntar,
            'waktu_antar'     =>$waktu_antar,

        ]);
      }
}


public function actionEndOrder(){
    $this->layout = 'no-tab';
    return $this->render('end-order', [


        ]);

}

    /**
     * Lists all TBooking models.
     * @return mixed
     */
    public function actionIndex()
    {
       $session       = Yii::$app->session;
         //$this->layout = 'no-tab';
         $searchModel  = new TBookingSearch();
         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         $noOrder      = ArrayHelper::map(TBooking::find()->all(), 'id','id');
         $des      = ArrayHelper::map(TDestinasi::find()->all(), 'id','nama_destinasi');
         $sts      = ArrayHelper::map(TStatusOrder::find()->all(), 'id','status');
         $customer = ArrayHelper::map(TCustomer::find()->all(), 'id','nama_customer');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'noOrder'=>$noOrder,
            'des'=>$des,
            'sts'=>$sts,
            'customer'=>$customer,
            'session'=>$session,
        ]);
    }

    /**
     * Displays a single TBooking model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
       //  $this->layout = 'no-tab';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TBooking model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // $this->layout = 'no-tab';
        $model = new TBooking();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TBooking model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
  /*  public function actionUpdate($id)
    {
         //$this->layout = 'no-tab';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TBooking model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
   /* public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TBooking model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TBooking the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TBooking::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
