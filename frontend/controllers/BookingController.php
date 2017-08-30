<?php

namespace frontend\controllers;

use Yii;
use app\models\TBooking;
use app\models\TBookingSearch;
use app\models\TTraveler;
use app\models\TCustomer;
use app\models\TJemput;
use app\models\TAntar;
use app\models\TLokasiAj;
use app\models\TPembayaran;
use app\models\TAreaAj;
use app\models\TarifAj;
use app\models\TDestinasi;
use app\models\TJenisTarifAj;
use app\models\WaktuJemput;
use app\models\TMetodePembayaran;
use app\models\TTransport;
use common\models\TExtraData;
use \yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Response;
use kartik\mpdf\Pdf;
use yii\helpers\FileHelper;


/**
 * TBookingController implements the CRUD actions for TBooking model.
 */
class BookingController extends Controller
{
    
     //* @inheritdoc

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


  public function beforeAction($action){
   
   $session       = Yii::$app->session;
    if ($session['timeout'] < date('H:i:s') || $session['timeout'] == null) {
      $modelDestinasi = $this->findDestinasi($session['destinasi.id_destinasi']);
      $modelDestinasi->stok_seat    = $modelDestinasi->stok_seat + $session['booking.pax_request'];
      $modelDestinasi->save();
      $session['alert'] = true;
    return $this->redirect('/')->send();
    }else{
      return true;
    }
  }

public function actionTermService(){
    $modelTerm = TExtraData::findOne(1);

    return $this->renderAjax('term-service',[
                            'modelTerm'=>$modelTerm
                            ]);
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
      $lokasi = TAreaAj::findOne($id_lokasi);
    if(($Area = WaktuJemput::find()->where(['id_destinasi'=>$id_destinasi])->andWhere(['id_lokasi_aj'=>$lokasi->id_lokasi_aj])->one()) !== null){
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

        echo "<h7>Your Pickup Time  <strong>".date('G:i',strtotime($waktu_jemput->start_time))." - ".date('G:i',strtotime($waktu_jemput->end_time))."</strong> </h7>";
        }else{

        $session['jemput.id_jam_jemput'] = $waktu_jemput;

        echo "<h7> Pick-up time will be notified later </h7>";
        }

}
}


protected function cariTarif($id_area){
   $session      = Yii::$app->session;
    //$session->open();
    $id_destinasi =$session['destinasi.id_destinasi'];
    if(($Dual = TarifAj::find()->where(['id_destinasi'=>$id_destinasi])->andWhere(['id_area'=>$id_area])->andWhere(['id_jenis_tarif'=>1])->one()) !== null){
        return $Dual;
    }elseif(($Sharing = TarifAj::find()->where(['id_destinasi'=>$id_destinasi])->andWhere(['id_area'=>$id_area])->andWhere(['id_jenis_tarif'=>2])->one()) !== null){
        return $Sharing;
    }elseif(($Private = TarifAj::find()->where(['id_destinasi'=>$id_destinasi])->andWhere(['id_area'=>$id_area])->andWhere(['id_jenis_tarif'=>3])->one()) !== null){
        return $Private;
    }else{
        return null;
    }
}

protected function Trans($paxDA){
  if (($modelTrans = TTransport::find(['id'=>1])->joinWith('idJenisTrans')->andWhere('t_jenis_trans.pass_max >= :paxDA',[':paxDA'=>$paxDA])->one()) !== null) {
    //Transport Car
    return $modelTrans;

  }elseif (($modelTrans = TTransport::find(['id'=>2])->joinWith('idJenisTrans')->andWhere('t_jenis_trans.pass_max >= :paxDA',[':paxDA'=>$paxDA])->one()) !== null) {
    //Transport Car & Elf
    return $modelTrans;
  }else{
    //Transport Elf
      $modelElf = TTransport::findOne(2);
      return $modelElf;
  }
  
}



public function actionExtraPickup(){
        if (Yii::$app->request->isAjax) {
            $data      =  Yii::$app->request->post();
            $id_area   =  $data['ida'];
           // $id_lokasi =  $data['idl'];
            $session   = Yii::$app->session;
            $session->open();
            $paxDA = $session['booking.dewasa'] + $session['booking.anak'];
            $Tarif     = $this->cariTarif($id_area);

            if ($Tarif == null ) {
            echo "Charges and pick-up method will be notified later By Cs";
            $session['jemput.biaya'] = 0;
            $session['jemput.metode'] = null;
            }elseif ($Tarif->id_jenis_tarif == 1 ) {
                $session['jemput.tarif_pax'] = number_format($Tarif->tarif_pax/$session['currency.round_kurs'],2);
                $session['jemput.tarif_car'] = number_format($Tarif->tarif_car/$session['currency.round_kurs'],2);
                $session['jemput.tarif_elf'] = number_format($Tarif->tarif_elf/$session['currency.round_kurs'],2);
                $session['jemput.biaya']     = number_format($Tarif->tarif_pax * $paxDA/$session['currency.round_kurs'],2);
                $session['jemput.metode']    = 2;

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
                <h5 id='cost-pick'>Charges ".$session['currency.id']." ".$session['jemput.tarif_pax']." x ". $paxDA." pax =  <strong> ".$session['currency.id']." ".$session['jemput.biaya']."</strong></h5>";
            //echo "Dual Mode";
        
        //$session['jemput.biaya']  = $Tarif->biaya;
        //echo "<h4>Biaya / Car  Rp ".number_format($Tarif->tarif_car,0)." </h4>
        //<h4>Biaya / Car  Rp ".number_format($Tarif->tarif_pax,0)." </h4>";
        }elseif ($Tarif->id_jenis_tarif == 2 ) {
            $session['jemput.biaya'] = number_format($Tarif->tarif_pax*$paxDA/$session['currency.round_kurs'],2);
            $session['jemput.metode'] = 2;
            echo "Metode Penjemputan Sharing<br>Charges ".$session['currency.id']." ".number_format($Tarif->tarif_pax/$session['currency.round_kurs'],2)." x ".$paxDA." pax =  <strong>".$session['currency.id']." ".$session['jemput.biaya']."</strong>";
            
        }elseif ($Tarif->id_jenis_tarif == 3 ) {
          $Trans = $this->Trans($paxDA);
            if ($Trans->id == 2 && $Trans->idJenisTrans->pass_max < $paxDA) {
              //penumpang melebihi kapasitas elf
              // jika tipe hasil  = 1 elf + avanza, hasil = 2 alf + elf
              $bil = $paxDA/$Trans->idJenisTrans->pass_max;
              $hit = round($bil,0,PHP_ROUND_HALF_UP);
             $hit = 1 ? $TarifPrivate = $Tarif->tarif_elf+$Tarif->tarif_car : $TarifPrivate = $Tarif->tarif_elf+$Tarif->tarif_elf;
            }elseif($Trans->id == 2 && $Trans->idJenisTrans->pass_max >= $paxDA){
              $TarifPrivate = $Tarif->tarif_elf;
            }elseif($Trans->id == 1 && $Trans->idJenisTrans->pass_max >= $paxDA){
              $TarifPrivate = $Tarif->tarif_car;
            }
            $session['jemput.biaya'] = number_format($TarifPrivate/$session['currency.round_kurs'],2);
            $session['jemput.metode'] = 3;          
            echo "Metode Penjemputan Private<br>Charges <strong>".$session['currency.id']." ".$session['jemput.biaya']." </strong>";

        }else{

       // $session['jemput.biaya']  = "Kodong";
       echo "<h4>Something Is Wrong, Please Contact Us</h4>";
       $session['jemput.biaya'] = null;
        }

    }
}

public function actionDualMode(){
if (Yii::$app->request->isAjax) {
        $data      =  Yii::$app->request->post();
        $metode    = $data['metr'];
        $session   = Yii::$app->session;
        $paxDA = $session['booking.dewasa'] + $session['booking.anak'];
        if ($metode == 2 ) {

            $session['jemput.biaya'] = $session['jemput.tarif_pax']*$paxDA;
            $session['jemput.metode'] = 2;
            echo "Price ".$session['currency.id']." ".$session['jemput.tarif_pax']." x ".$paxDA." pax =  <strong>".$session['currency.id']." ".$session['jemput.biaya']."</strong>" ;

        }elseif ($metode == 3) {
            $Trans = $this->Trans($paxDA);
            if ($Trans->id == 2 && $Trans->idJenisTrans->pass_max < $paxDA) {
              //penumpang melebihi kapasitas elf
              //tipe hasil  = 1 elf + avanza, hasil = 2 alf + elf
              $bil = $paxDA/$Trans->idJenisTrans->pass_max;
              $hit = round($bil,0,PHP_ROUND_HALF_UP);
             $hit = 1 ? $TarifPrivate = $session['jemput.tarif_elf']+$session['jemput.tarif_car'] : $TarifPrivate = $session['jemput.tarif_elf']+$session['jemput.tarif_elf'];
              
              //$TarifPrivate = "1111111111";

            }elseif($Trans->id == 2 && $Trans->idJenisTrans->pass_max >= $paxDA){
              $TarifPrivate = $session['jemput.tarif_elf'];
            }elseif($Trans->id == 1 && $Trans->idJenisTrans->pass_max >= $paxDA){
              $TarifPrivate = $session['jemput.tarif_car'];
            }
             $session['jemput.biaya'] = $TarifPrivate;
            $session['jemput.metode'] = 3;
            echo "Price <strong>".$session['currency.id']." ".$session['jemput.biaya']." </strong>" ;
           
        }else{
            echo "Something Is Wrong, Please Contact Us";
            $session['jemput.biaya'] = null;
            $session['jemput.metode'] = null;
        }
}
}

public function actionExtraDrop(){
if (Yii::$app->request->isAjax) {
        $data      =  Yii::$app->request->post();
        $id_area   =  $data['ida'];
        $session   = Yii::$app->session;
        $session->open();
        $paxDA = $session['booking.dewasa'] + $session['booking.anak'];
        $Tarif     = $this->cariTarif($id_area);
        if ($Tarif == null ) {
            echo "Charges and Drop-Off method will be notified later By Cs";
            $session['antar.biaya'] = null;
            $session['antar.metode'] = null;

        }elseif ($Tarif->id_jenis_tarif == 1 ) {
        $session['antar.tarif_pax'] = number_format($Tarif->tarif_pax/$session['currency.round_kurs'],2);
        $session['antar.tarif_car'] = number_format($Tarif->tarif_car/$session['currency.round_kurs'],2);
        $session['antar.tarif_elf'] = number_format($Tarif->tarif_elf/$session['currency.round_kurs'],2);
        $session['antar.biaya']     = number_format($Tarif->tarif_pax*$paxDA/$session['currency.round_kurs'],2);
        $session['antar.metode'] = 2;
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
        </div><h5 id='cost-drop'>Charges ".$session['currency.id']." ".$session['antar.tarif_pax']." x ".$paxDA." pax =  <strong>".$session['currency.id']." ".$session['antar.biaya']."</strong></h5>";
            //echo "Dual Mode";
        
        //$session['jemput.biaya']  = $Tarif->biaya;
        //echo "<h4>Biaya / Car  Rp ".number_format($Tarif->tarif_car,0)." </h4>
        //<h4>Biaya / Car  Rp ".number_format($Tarif->tarif_pax,0)." </h4>";
        }elseif ($Tarif->id_jenis_tarif == 2 ) {
            $session['antar.biaya'] = number_format($Tarif->tarif_pax*$paxDA/$session['currency.round_kurs'],2);
            $session['antar.metode'] = 2;
            echo "Metode Drop-Off Sharing<br>Charges ".$session['currency.id']." ".number_format($Tarif->tarif_pax/$session['currency.round_kurs'],2)." x ".$paxDA." pax =  <strong>".$session['currency.id']." ".$session['antar.biaya']."</strong>";
            
        }elseif ($Tarif->id_jenis_tarif == 3 ) {
           $Trans = $this->Trans($paxDA);
            if ($Trans->id == 2 && $Trans->idJenisTrans->pass_max < $paxDA) {
              //penumpang melebihi kapasitas elf
              // jika tipe hasil  = 1 elf + avanza, hasil = 2 alf + elf
              $bil = $paxDA/$Trans->idJenisTrans->pass_max;
              $hit = round($bil,0,PHP_ROUND_HALF_UP);
             $hit = 1 ? $TarifPrivate = $Tarif->tarif_elf+$Tarif->tarif_car : $TarifPrivate = $Tarif->tarif_elf+$Tarif->tarif_elf;
            }elseif($Trans->id == 2 && $Trans->idJenisTrans->pass_max >= $paxDA){
              $TarifPrivate = $Tarif->tarif_elf;
            }elseif($Trans->id == 1 && $Trans->idJenisTrans->pass_max >= $paxDA){
              $TarifPrivate = $Tarif->tarif_car;
            }
            $session['antar.biaya'] = number_format($TarifPrivate/$session['currency.round_kurs'],2);
            $session['antar.metode'] = 3; 
            echo "Metode Drop-Off Private<br>Charges <strong>".$session['currency.id']." ".$session['antar.biaya']." </strong>";
           
        }else{

       // $session['jemput.biaya']  = "Kodong";
        echo "<h4>Something Is Wrong, Please Contact Us</h4>";
        $session['antar.biaya'] = null;
        $session['antar.metode'] = null;
        }
}
}


    

public function actionDualModel(){
if (Yii::$app->request->isAjax) {
        $data  =  Yii::$app->request->post();
        $metod = $data['metz'];
        $session   = Yii::$app->session;
        $session->open();
        $paxDA = $session['booking.dewasa'] + $session['booking.anak'];
        if ($metod == 2 ) {
            $session['antar.biaya'] = $session['antar.tarif_pax']*$paxDA;
            $session['antar.metode'] = 2;
            echo "Price ".$session['currency.id']." ".$session['antar.tarif_pax']." x ".$paxDA." pax =  <strong>".$session['currency.id']." ".$session['antar.biaya']."</strong>";
            
        }elseif ($metod == 3) {
           $Trans = $this->Trans($paxDA);
            if ($Trans->id == 2 && $Trans->idJenisTrans->pass_max < $paxDA) {
              //penumpang melebihi kapasitas elf
              //tipe hasil  = 1 elf + avanza, hasil = 2 alf + elf
              $bil = $paxDA/$Trans->idJenisTrans->pass_max;
              $hit = round($bil,0,PHP_ROUND_HALF_UP);
             $hit = 1 ? $TarifPrivate = $session['antar.tarif_elf']+$session['antar.tarif_car'] : $TarifPrivate = $session['antar.tarif_elf']+$session['antar.tarif_elf'];
              
              //$TarifPrivate = "1111111111";

            }elseif($Trans->id == 2 && $Trans->idJenisTrans->pass_max >= $paxDA){
              $TarifPrivate = $session['antar.tarif_elf'];
            }elseif($Trans->id == 1 && $Trans->idJenisTrans->pass_max >= $paxDA){
              $TarifPrivate = $session['antar.tarif_car'];
            }
            $session['antar.biaya'] = $TarifPrivate;
            $session['antar.metode'] = 3;
            echo "Price <strong>".$session['currency.id']." ".$session['antar.biaya']." </strong>" ;
            
        }else{
            $session['antar.metode'] = null;
            echo "Something Is Wrong, Please Contact Us";
           
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

     //PICKUP AND DROP OFF
    public function actionTahap2()
    {
        $session   = Yii::$app->session; 

        $modelAntar  = new TAntar();
        $modeljemput = new TJemput();
       // $listAJ      = ArrayHelper::map(TLokasiAj::find()->all(), 'id', 'lokasi_aj');
        $areaAJ      = ArrayHelper::map(TAreaAj::find()->orderBy(['id_lokasi_aj'=>SORT_ASC])->all(), 'id', 'nama_area');
if ($modeljemput->load(Yii::$app->request->post()) && $modelAntar->load(Yii::$app->request->post())) {
        //for Jemput
       $session   = Yii::$app->session;

  if ($modeljemput->nama_area == null && $modelAntar->nama_area == null ) {
                $session['jemput.id_area_jemput'] = null;
                $session['antar.id_area_antar'] = null;
                return $this->redirect('check-out');
         
    }elseif ($modeljemput->nama_area != null && $modelAntar->nama_area == null ) {
              $session['antar.id_area_antar'] = null;
              $idArea2 = $modeljemput->nama_area;
               if (($areajemput  = $this->cariArea($idArea2)) === null) {
                $saveArea2  = new TAreaAj();
                $saveArea2->load(Yii::$app->request->post());
               // $saveArea2->id_lokasi_aj        = $modeljemput->lokasi_jemput;
                $saveArea2->nama_area           = $modeljemput->nama_area;
                $saveArea2->save();
                $session['jemput.id_area_jemput'] = $saveArea2->id;
                }else{
                $session['jemput.id_area_jemput'] = $idArea2;
                }

               // $session['jemput.lokasi_jemput']    = $modeljemput->lokasi_jemput;
                $session['jemput.alamat_jemput']    = $modeljemput->alamat_jemput;
                $session['jemput.no_telp_jemput']   = $modeljemput->no_telp_jemput;
                return $this->redirect('check-out');

    }elseif ($modeljemput->nama_area == null && $modelAntar->nama_area != null  ) {
             $session['jemput.id_area_jemput'] = null;
             $idArea = $modelAntar->nama_area;
              if (($areaAntar  = $this->cariArea($idArea)) == null) {
                $saveArea  = new TAreaAj();
                $saveArea->load(Yii::$app->request->post());
               // $saveArea->id_lokasi_aj         = $modelAntar->lokasi_antar;
                $saveArea->nama_area            = $modelAntar->nama_area;
                $saveArea->save();
                $session['antar.id_area_antar'] = $saveArea->id;
                }else{
                $session['antar.id_area_antar'] = $idArea;
              }
                  // $session['antar.id_booking']   = $modelBooking->id;
                  //$session['antar.lokasi_antar']    = $modelAntar->lokasi_antar;
                  $session['antar.alamat_antar']    = $modelAntar->alamat_antar;
                  $session['antar.no_telp_antar']   = $modelAntar->no_telp_antar;

                  return $this->redirect('check-out');
    }elseif ($modeljemput->nama_area != null && $modelAntar->nama_area != null ) {

              $idArea2 = $modeljemput->nama_area;
               if (($areajemput  = $this->cariArea($idArea2)) === null) {
                $saveArea2  = new TAreaAj();
                $saveArea2->load(Yii::$app->request->post());
               // $saveArea2->id_lokasi_aj        = $modeljemput->lokasi_jemput;
                $saveArea2->nama_area           = $modeljemput->nama_area;
                $saveArea2->save();
                $session['jemput.id_area_jemput'] = $saveArea2->id;
                }else{
                $session['jemput.id_area_jemput'] = $idArea2;
                }

               // $session['jemput.lokasi_jemput']    = $modeljemput->lokasi_jemput;
                $session['jemput.alamat_jemput']    = $modeljemput->alamat_jemput;
                $session['jemput.no_telp_jemput']   = $modeljemput->no_telp_jemput;
               $idArea = $modelAntar->nama_area;
              if (($areaAntar  = $this->cariArea($idArea)) == null) {
                $saveArea  = new TAreaAj();
                $saveArea->load(Yii::$app->request->post());
               // $saveArea->id_lokasi_aj         = $modelAntar->lokasi_antar;
                $saveArea->nama_area            = $modelAntar->nama_area;
                $saveArea->save();
                $session['antar.id_area_antar'] = $saveArea->id;
                }else{
                $session['antar.id_area_antar'] = $idArea;
              }

              $session['antar.alamat_antar']    = $modelAntar->alamat_antar;
              $session['antar.no_telp_antar']   = $modelAntar->no_telp_antar;

               return $this->redirect('check-out');
              //unset($session['antar.biaya']);
    }else{
       
       return $this->redirect('end-order');

        }


    }
        return $this->render('tahap-2', [
        'modelAntar'=>$modelAntar,
        'modeljemput'=>$modeljemput,
      //  'listAJ'=> $listAJ,
        'areaAJ'=>$areaAJ,
        'session'=>$session
                ]);

    }


   
    public function actionCheckOut()
    {
        $session         = Yii::$app->session;
        
        $modelCustomer   = new TCustomer;
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


    if ($modelCustomer->load(Yii::$app->request->post()) && Model::loadMultiple($TravelerDewasa, Yii::$app->request->post()))
    {


        try{

            $transaction = Yii::$app->db->beginTransaction();
                    $modelCustomer->validate();
                    $modelCustomer->save(false);
                    $modelBooking    = new TBooking;
                    $modelBooking->load(Yii::$app->request->post());
                    $modelBooking->id_destinasi = $session['destinasi.id_destinasi'];
                    $modelBooking->id_customer  = $modelCustomer->id;
                    $modelBooking->tgl_trip     = date('Y-m-d', strtotime($session['booking.tgl_trip']));
                    $modelBooking->biaya_trip   = $session['booking.biaya_trip'];
                    $modelBooking->total_pax    = $session['booking.total_pax'];
                    $modelBooking->biaya_jemput = $session['jemput.biaya'];
                    $modelBooking->biaya_antar  = $session['antar.biaya'];
                    
                    $modelBooking->total_biaya   = $session['booking.biaya_trip'] + $modelBooking->biaya_jemput + $modelBooking->biaya_antar;
                   // $now                         = date('Y-m-d 16:i:s');
                    $modelBooking->waktu_booking = date('Y-m-d H:i:s');
                   // $waktu_exp                   = date('Y-m-d 16:00:00',strtotime($now));
                    $modelBooking->id            = $modelBooking->generateBookingNumber("id");
                   // $modelBooking->waktu_exp     = $waktu_exp;

                    
                    
                    if ($modelBooking->tgl_trip > date('Y-m-d',strtotime('+1 day'))) {
                      //exp tomorrow for booking later
                    $modelBooking->waktu_exp = date('Y-m-d 16:00:00',strtotime('+1 day'));
                   
                    }else{
                    //exp today for booking tomorrow
                    $modelBooking->waktu_exp = date('Y-m-d 16:00:00',strtotime('-1 day',strtotime($modelBooking->tgl_trip)));
                 
                    }
                    $modelBooking->validate();
                    $modelBooking->save();
                    $session['booking.id']          = $modelBooking->id;
                    $session['booking.total_biaya'] = $modelBooking->total_biaya;

                    $modelpembayaran                   = new TPembayaran();
                    $modelpembayaran->load(Yii::$app->request->post());
                    $modelpembayaran->token_konfirmasi = $modelpembayaran->generatePaymentToken("token_konfirmasi");
                    $modelpembayaran->id_booking       = $modelBooking->id;
                    $modelpembayaran->currency         = $session['currency.id'];
                    $modelpembayaran->save();
                    $session['pembayaran.token']       = $modelpembayaran->token_konfirmasi;

                    if ($session['jemput.id_area_jemput'] != null) {
                      $modelJemput                   = new TJemput();
                      $modelJemput->load(Yii::$app->request->post());
                      $modelJemput->id_booking       = $modelBooking->id;
                      $modelJemput->id_area_jemput   = $session['jemput.id_area_jemput'];
                      $modelJemput->id_metode_jemput = $session['jemput.metode'];
                      $modelJemput->id_jam_jemput    = $session['jemput.id_jam_jemput'];
                      $modelJemput->no_telp_jemput   = $session['jemput.no_telp_jemput'];
                      $modelJemput->alamat_jemput    = $session['jemput.alamat_jemput'];
                      $modelJemput->biaya_jemput     = $session['jemput.biaya'];
                      $modelJemput->save();
                      }
                    if ($session['antar.id_area_antar'] != null) {
                      $modelAntar                  = new TAntar();
                      $modelAntar->load(Yii::$app->request->post());
                      $modelAntar->id_booking      = $modelBooking->id;
                      $modelAntar->id_area_antar   = $session['antar.id_area_antar'];
                      $modelAntar->id_metode_antar = $session['antar.metode'];
                      $modelAntar->no_telp_antar   = $session['antar.no_telp_antar'];
                      $modelAntar->alamat_antar    = $session['antar.alamat_antar'];
                      $modelAntar->biaya_antar     = $session['antar.biaya'];
                      $modelAntar->save();
                    }
                    

                    
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

                    $session['timeout'] = true;
                   // $expBook            = strtotime ('+30 minute', strtotime ( $session['timeout'] ) ) ;
                   // $session['timeout'] = date ('Y-m-d H:i:s' , $expBook );

            $transaction->commit();

                    return $this->redirect('payment');
      } catch(Exception $e){
                    $transaction->rollback();
                   // $modelBooking->delete();
                    //$session->destroy();
                    //$session->close();
                    throw $e;
        }
    }else{
        return $this->render('check-out', [
            'modelCustomer'  => $modelCustomer,
            'modelCustomer'  => $modelCustomer,
            'TravelerDewasa' => $TravelerDewasa,
            'TravelerAnak'   => $TravelerAnak,
            'Travelerbayi'   => $Travelerbayi,
            'listAJ'         => $listAJ,
            'session'        => $session,
            'dewasa'         => $dewasa,
            'anak'           => $anak,
            'bayi'           => $bayi,
            'mx'             => $mx,
            'metode_jemput'  =>$metode_jemput,
            'metode_antar'   =>$metode_antar,
            'waktu_jemput'   =>$waktu_jemput,
            'AreaAntar'      =>$AreaAntar,
            'Areajemput'     =>$Areajemput,


        ]);
      }
}




public function actionPaypal(){
     $session = Yii::$app->session;
     if (($modelpembayaranPaypal = $this->findPayment($session['pembayaran.token'])) !== null) {
       $maskToken =  Yii::$app->getSecurity()->maskToken($modelpembayaranPaypal->token_konfirmasi);
       echo $this->renderAjax('paypal',[
         'session'=>$session,
         'maskToken'=>$maskToken
      ]);
     }else{
        throw new NotFoundHttpException('Your Request Cannot Proses, Please Contact Us');
     }

   
}

public function actionSuccess(){
  
    if (Yii::$app->request->isAjax) {
            try {
              $transaction = Yii::$app->db->beginTransaction();
              $session = Yii::$app->session;
                 $data                             = Yii::$app->request->post();
                 $type                             = '2';
                 $modelpembayaranPaypal            = $this->findPayment($data['umk'],$type);
                 $modelBooking                     = $this->findBooking($modelpembayaranPaypal->id_booking);
                // $modelpembayaranPaypal->load(Yii::$app->request->post());
                 $modelpembayaranPaypal->id_metode = '2';
                 $modelpembayaranPaypal->tgl_kirim = date('Y-m-d');
                 //s$modelpembayaranPaypal->currency = $session['currency.id'];
                 $modelpembayaranPaypal->nama_pengirim = $modelBooking->idCustomer->nama_customer;
                 $modelpembayaranPaypal->jumlah_kirim = $modelBooking->total_biaya;
                 $modelpembayaranPaypal->save();
                 
                 //Auto Confirm
                 if ($modelBooking->idDestinasi->id_jenis_konfirmasi == 1) {
                 $modelBooking->id_status          = '3';
                 $modelBooking->save();
                 $this->sendTicket($modelBooking);
                 $transaction->commit();
                 //Manual Confirm
                 }else{
                 $modelBooking->id_status          = '2';
                 $modelBooking->save();
              $transaction->commit();
                 
                 }
                 $session      = session_unset();
                 $session = Yii::$app->session;
                 $session->open();
                 $session['timeout'] = 'sukses';
                 return $this->redirect('/');
                
                 
            } catch (Exception $e) {
                $transaction->rollback();
                throw $e;
            }
                 

        }else{
          throw new NotFoundHttpException('The requested page Cannot Be Process.');
        }
}


    public function actionPayment()
    {

      $session = Yii::$app->session;
      $modelpembayaran                   = new TPembayaran();
      $metode_bayar                      = ArrayHelper::map(TMetodePembayaran::find()->all(), 'id', 'metode');

        if (Yii::$app->request->isPost) {
          $session = Yii::$app->session;
            try{
                  $transaction = Yii::$app->db->beginTransaction();
                    $modelpembayaranTransfer            = $this->findPayment($session['pembayaran.token']);
                    $modelBooking                       = $this->findBooking($modelpembayaranTransfer->id_booking);
                    $maskToken =  Yii::$app->getSecurity()->maskToken($modelpembayaranTransfer->token_konfirmasi);
                    $this->mailInvoice($modelBooking,$maskToken);
                    $session = Yii::$app->session;
                    $session->open();
                    $session['timeout'] = 'sukses';
                    $transaction->commit();
                 
                 return $this->redirect('/');
            } catch (Exception $e) {
                 //$session      = session_unset();
                    $transaction->rollback();
                        throw $e;
              }
        }else{
               
            
                return $this->render('payment', [
                'modelpembayaran' =>$modelpembayaran,
                'metode_bayar'    =>$metode_bayar,
                'session'         =>$session,
               
                ]);
          }
    }

    protected function mailInvoice($modelBooking,$maskToken)
    {
        $session = Yii::$app->session;
        Yii::$app->mailReservation->compose()->setFrom('reservation@traviora.com')
                   ->setTo($session['customer.email'])
                   ->setSubject('Invoice Traviora')
                   ->setHtmlBody($this->renderAjax('email',[
                    'modelBooking'=>$modelBooking,
                    'maskToken'=>$maskToken,
                    'session'=>$session,
                    ]))->send();
    }

    public function actionEndOrder(){

        Yii::$app->getSession()->setFlash(
                                                'success','Payment Succesfull, Thanks' );
        return $this->render('end-order');

    }


//type 1 token tidak di mask type 2 token di mask
    protected function findPayment($maskToken,$type = 1){
      if ($type == 1) {
       if (($model = TPembayaran::findOne(['token_konfirmasi'=>$maskToken])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Data Token Not Found');
        }
      }elseif ($type == '2') {
         $unmaskToken = Yii::$app->getSecurity()->unmaskToken($maskToken);
        if (($model = TPembayaran::findOne(['token_konfirmasi'=>$unmaskToken])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Unmask Token Not Found');
        }
      }else{
        throw new NotFoundHttpException('Payment Not Found');
      }
    }
       


protected function sendTicket($modelBooking)
    {
 
        try {
          $transaction = Yii::$app->db->beginTransaction();

            $modelCustomer           = TCustomer::findOne($modelBooking->id_customer);
            $TravelerDewasa          = TTraveler::find()->where(['id_leader'=>$modelCustomer->id])->andWhere(['id_jenis_anggota'=>1])->all();
            $TravelerAnak            = TTraveler::find()->where(['id_leader'=>$modelCustomer->id])->andWhere(['id_jenis_anggota'=>2])->all();
            $TravelerBayi            = TTraveler::find()->where(['id_leader'=>$modelCustomer->id])->andWhere(['id_jenis_anggota'=>3])->all();
            
            $modelJemput = TJemput::findOne(['id_booking'=>$modelBooking->id]);
            $modelAntar = TAntar::findOne(['id_booking'=>$modelBooking->id]);
            

             $saveTiket = Yii::$app->basePath."/File-Pesanan/".$modelBooking->id."/";
             FileHelper::createDirectory ( $saveTiket, $mode = 0777, $recursive = true );
             $pdf = new Pdf([
        'filename'=>$saveTiket.'E-Tiket.pdf',
        // A4 paper format
        'format' => Pdf::FORMAT_A4, 
        // portrait orientation
        'orientation' => Pdf::ORIENT_PORTRAIT, 
        // simpan file
        //'destination' => Pdf::DEST_BROWSER,
        'destination' => Pdf::DEST_FILE, 

        //'tempPath'=>$path,
        //'path'=>$saveTiket,

        // your html content input
        'content' => "
            ".$this->renderAjax('pdf-ticket',[
                'modelBooking'=>$modelBooking,
                'modelCustomer'=>$modelCustomer,
                'TravelerDewasa'=>$TravelerDewasa,
                'TravelerAnak'=>$TravelerAnak,
                'TravelerBayi'=>$TravelerBayi,
                'modelJemput'=>$modelJemput,
                'modelAntar'=>$modelAntar
                ])." ",  
                        // format content from your own css file if needed or use the
                        // enhanced bootstrap css built by Krajee for mPDF formatting 
                       // 'cssFile'   => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
                        // any css to be embedded if required
                        'cssInline' => '.kv-heading-1{font-size:18px}', 
                        //set mPDF properties on the fly
                        'options'   => ['title' => 'E-tiket Traviora'],
                        // call mPDF methods on the fly
                        'methods'   => [ 
                        'SetHeader' =>['E-tiket Traviora'], 
                        'SetFooter' =>['Please take this tiket on your trip departure as a justification'],
                ]
            ]); $pdf->render();

             //to Guest
            Yii::$app->mailReservation->compose()->setFrom('reservation@traviora.com')
            ->setTo($modelBooking->idCustomer->email)
            ->setSubject('E-TIKET TRAVIORA.COM')
            ->setHtmlBody($this->renderAjax('email-ticket',['modelBooking'=>$modelBooking]))
            ->attach($saveTiket."E-Tiket.pdf")
            ->send();
         
            //to supplier
            Yii::$app->mailReservation->compose()->setFrom('reservation@traviora.com')
            ->setTo($modelBooking->idDestinasi->idSupplier->email)
            ->setSubject('Supplier Reservation Traviora.com')
            ->setHtmlBody($this->renderAjax('email-supplier',[
                'modelBooking'   =>$modelBooking,
                'modelCustomer'  =>$modelCustomer,
                'TravelerDewasa' =>$TravelerDewasa,
                'TravelerAnak'   =>$TravelerAnak,
                'TravelerBayi'   =>$TravelerBayi,
                'modelJemput'    =>$modelJemput,
                'modelAntar'     =>$modelAntar
                ]))
            ->send();
        FileHelper::removeDirectory($saveTiket);
        $transaction->commit();
            Yii::$app->getSession()->setFlash(
                                            'success','Payment Successfull' );
    } catch (Exception $e) {
                $transaction->rollback();
                Yii::$app->getSession()->setFlash(
                                            'error','Payment Failed, Please Contact Us' );
            }
      
    }

        
    protected function findDestinasi($id)
    {
        if (($model = TDestinasi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }    

    protected function findBooking($id)
    {
        if (($model = TBooking::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
