<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
$this->title = 'CHECK OUT';
var_dump($session['jemput.metode']);
var_dump($session['booking.biaya_trip']);
?>
<?php
$this->registerJs("
$(document).ready(function(){
   $('.edited').prop('disabled', true);
   $('.edited').prop('disabled', true);
   $('#tgl-trip').prop('disabled', true);
   $('#cekbox').prop('disabled', false);
   $('#btn-ok').hide();
});
$('#btn-edit').on('click',function(){
   $('.edited').prop('readonly', false);
   $('.edited').prop('disabled', false);
   $('#tgl-trip').prop('disabled', false);
   $('#tgl-trip').prop('readonly', false);
   $('#btn-confirm').hide();
   $('#setuju').hide();
   $('#btn-edit').hide();
   $('#btn-ok').show();
});

$('#btn-ok').on('click',function(){
   $('.edited').prop('disabled', true);
   $('.edited').prop('disabled', true);
   $('#tgl-trip').prop('disabled', true);
   $('#cekbox').prop('disabled', false);
   $('#setuju').show();
   $('#btn-ok').hide();
   $('#btn-edit').show();
   $('#btn-confirm').show();
});

$('#cekbox').on('change',function(){
  
    if ($(this).is(':checked')) {
     $('#btn-confirm').prop('disabled', false);
     $('#btn-confirm').removeClass('disabled');
     $('#btn-confirm').addClass('active');
    }else{
      $('#btn-confirm').prop('disabled', true);
      $('#btn-confirm').removeClass('active');
     $('#btn-confirm').addClass('disabled');
    }
});

$('#btn-confirm').on('click', function(){
  $('.edited').prop('disabled', false);
   $('.edited').prop('disabled', false);
   $('#tgl-trip').prop('disabled', false);
});

$('#btn-detail').on('click', function(){
  $('#div-detail').toggle('1500');
   
});




");

?>
<div class="panel panel-primary">
<div class="panel-heading"><center><h3>KONFIRMASI</h3></center></div>
<div class="panel-body">
<?php $form = ActiveForm::begin([]);?>
  <div class="col-md-4">
  <div class="panel panel-primary">
  <div class="panel-heading">TRIP DETAIL</div>
    <ul class="list-group">
      <li class="list-group-item">Destinasi <strong style="font-size: 20px;" class="pull-right"><?= $session['destinasi.nama_destinasi'] ?> </strong> </li>
            <li class="list-group-item">Tanggal Trip <strong style="font-size: 15px;" class="pull-right"><?= date('d-m-Y', strtotime($session['booking.tgl_trip'])) ?></strong> </li>
            <li class="list-group-item">TOTAL <strong class="pull-right"> <?= $session['booking.total_pax']?> Pax </strong></li>

    </ul>
          <div class="panel-body">
          <?= Html::button('DETAIL NAMA', ['class' => 'btn btn-sm btn-block btn-info','id'=>'btn-detail']); ?>
          </div>
  </div>
  </div>

      <div class="col-md-4">
      <div class="panel panel-primary">
      <div class="panel-heading">PAX DETAIL</div>
      
          <ul class="list-group">
            <li class="list-group-item">Traveler Dewasa <strong class="pull-right"><?= $session['traveler.jml_dewasa']?> Pax </strong></li>
            <li class="list-group-item">Traveler Anak<strong class="pull-right"><?= $session['traveler.jml_anak']?> Pax</strong></li>
            <li class="list-group-item">Traveler bayi<strong class="pull-right"><?= $session['traveler.jml_bayi']?> Pax</strong></li>

          </ul>
          </div>
      </div>


<div class="col-md-4">
<div class="panel panel-primary">
      <div class="panel-heading">CONTACT DETAIL</div>
         <div class="panel-body">
<?= $form->field($modelCustomer, 'nama_customer')->textInput(['class'=>'edited form-control','value'=>$session['customer.nama_customer']]) ?>
<?= $form->field($modelCustomer, 'email')->textInput(['class'=>'edited form-control','value'=>$session['customer.email']]) ?>
<?= $form->field($modelCustomer, 'no_telp')->textInput(['class'=>'edited form-control','value'=>$session['customer.telp']]) ?>
</div>
</div>
</div>
<div id="div-detail" class="col-md-12" style="display: block;">
      <div class="panel panel-primary">
      <div class="panel-heading">DETAIL NAMA TRAVELER</div>
      <div class="panel-body">
       <?= $this->render('_paxDetail', [
            'TravelerDewasa' => $TravelerDewasa,
            'TravelerAnak'   => $TravelerAnak,
            'Travelerbayi'   => $Travelerbayi,
            'dewasa'         => $dewasa,
            'anak'           => $anak,
            'bayi'           => $bayi,
            'form'           => $form,
            'session'=>$session,
          ]) ?>


      </div>
      </div>
      </div>
<div class="col-md-6">
<div class="panel panel-primary">
<div class="panel-heading">PENJEMPUTAN ( PICKUP )</div>
    <ul class="list-group">
    <?php 
    if ($Areajemput !== null) {
      echo "<li class='list-group-item'>Area<strong class='pull-right'>". $Areajemput->idLokasiAj->lokasi_aj ."</strong></li>
            <li class='list-group-item'>Lokasi <strong class='pull-right'>". $Areajemput->nama_area ."</strong></li>
            <li class='list-group-item'>Alamat Jelas <strong class='pull-right'>". $session['jemput.alamat_jemput'] ."</strong></li>
            <li class='list-group-item'>No Telp<strong class='pull-right'>". $session['jemput.no_telp_jemput'] ."</strong></li>";
          if ($metode_jemput !== null && $metode_jemput->id == 2) {
                    echo "<li class='list-group-item'>Metode <strong class='pull-right'>".$metode_jemput->jenis_tarif."</strong></li>
                       <li class='list-group-item'>Biaya <strong class='pull-right'>Rp ". number_format($session['jemput.biaya'],0) ." / Pax</strong></li>";
                 }elseif ($metode_jemput !== null && $metode_jemput->id == 3) {
                    echo "<li class='list-group-item'>Metode <strong class='pull-right'>".$metode_jemput->jenis_tarif."</strong></li>
                       <li class='list-group-item'>Biaya <strong class='pull-right'>Rp ". number_format($session['jemput.biaya'],0) ." / Car</strong></li>";
                 }else{
                    echo "<li class='list-group-item'>Metode <strong class='pull-right'> Menyusul </strong></li>
                        <li class='list-group-item'>Biaya <strong class='pull-right'> Menyusul </strong></li>";
                  }
      echo "<li class='list-group-item'>Jam <strong class='pull-right'>".$waktu_jemput->start_time." - ".$waktu_jemput->end_time."</strong></li>";

    }else{
      echo "<li class='list-group-item'>Area<strong class='pull-right'>No Pickup</strong></li>";
      } ?>
            
            
            
            

          </ul>
</div>
</div>

<div class="col-md-6">
<div class="panel panel-primary">
      <div class="panel-heading">PENGATARAN ( DROP OFF )</div>

              <ul class="list-group">
              <?php 
              if ($AreaAntar !== null) {
                echo "<li class='list-group-item'>Area<strong class='pull-right'>". $AreaAntar->idLokasiAj->lokasi_aj ."</strong></li>
                    <li class='list-group-item'>Lokasi <strong class='pull-right'>". $AreaAntar->nama_area ."</strong></li>
                    <li class='list-group-item'>Alamat Jelas <strong class='pull-right'>". $session['antar.alamat_antar'] ."</strong></li>
                    <li class='list-group-item'>No Telp<strong class='pull-right'>". $session['antar.no_telp_antar'] ."</strong></li>";
                  if ($metode_antar !== null && $metode_antar->id == 2) {
                    echo "<li class='list-group-item'>Metode <strong class='pull-right'>".$metode_antar->jenis_tarif."</strong></li>
                       <li class='list-group-item'>Biaya <strong class='pull-right'>Rp ". number_format($session['antar.biaya'],0) ." / Pax</strong></li>
                       <li class='list-group-item'>-<strong class='pull-right'>-</strong></li>";
                 }elseif ($metode_antar !== null && $metode_antar->id == 3) {
                    echo "<li class='list-group-item'>Metode <strong class='pull-right'>".$metode_antar->jenis_tarif."</strong></li>
                       <li class='list-group-item'>Biaya <strong class='pull-right'>Rp ". number_format($session['antar.biaya'],0) ." / Car</strong></li>
                       <li class='list-group-item'>-<strong class='pull-right'></strong></li>";
                 }else{
                    echo "<li class='list-group-item'>Metode <strong class='pull-right'> Menyusul </strong></li>
                        <li class='list-group-item'>Biaya <strong class='pull-right'> Menyusul </strong></li>
                        <li class='list-group-item'>-<strong class='pull-right'>-</strong></li>";
                  }
              }else{
              echo "<li class='list-group-item'>Area<strong class='pull-right'>No Drop Off</strong></li>";
              } ?>
           
            
            
            
              

          </ul>
        
</div>
</div>

<div class="panel-heading"><center><h3><strong>DETAIL BIAYA</strong></h3></center></div>
<div class="col-md-4">
<div class="panel panel-primary">
      <div class="panel-heading">DETAIL BIAYA TRIP</div>
        
          <ul class="list-group">
            <li class="list-group-item">Biaya Trip Dewasa<strong class="pull-right"><?= "Rp ".number_format($session['booking.biaya_dewasa'])?></strong></li>
            <li class="list-group-item">Biaya Trip Anak<strong class="pull-right"><?= "Rp ".number_format($session['booking.biaya_anak'])?></strong></li>
            <li class="list-group-item">Biaya Trip Bayi<strong class="pull-right"><?= "Rp ".number_format($session['booking.biaya_bayi'])?></strong></li>
            <li class="list-group-item">Total Biaya Trip<strong class="pull-right"><?= "Rp ".number_format($session['booking.biaya_dewasa']+$session['booking.biaya_anak']+$session['booking.biaya_bayi'])?></strong></li>

          </ul>


</div>
</div>

<div class="col-md-4">
<div class="panel panel-primary">
      <div class="panel-heading">DETAIL BIAYA PICKUP & DROP OFF</div>
         <ul class="list-group">
            <li class="list-group-item">Biaya Jemput (Pickup)<strong class="pull-right"><?= "Rp ".number_format($session['jemput.biaya'])?></strong></li>
            <li class="list-group-item">Biaya Antar (Drop Off)<strong class="pull-right"><?= "Rp ".number_format($session['antar.biaya'])?></strong></li>
            <li class="list-group-item">Total Pickup dan Drop off<strong class="pull-right"><?= "Rp ".number_format($session['jemput.biaya'] + $session['antar.biaya'])?></strong></li>

          </ul>



</div>
</div>

<div class="col-md-4">
<div class="panel panel-primary">
      <div class="panel-heading">DETAIL BIAYA & PEMBAYARAN</div>
   <ul class="list-group">
            <li class="list-group-item">Biaya trip<strong class="pull-right"><?= "Rp ".number_format($session['booking.biaya_dewasa']+$session['booking.biaya_anak']+$session['booking.biaya_bayi'])?></strong></li>
            <li class="list-group-item">Biaya Pickup & Drop Off<strong class="pull-right"><?= "Rp ".number_format($session['jemput.biaya'] + $session['antar.biaya'])?></strong></li>
            <li class="list-group-item"><strong>Total tagihan</strong><strong class="pull-right"><?= "Rp ".number_format($session['booking.biaya_trip']+$session['jemput.biaya']+$session['antar.biaya'])?></strong></li>
            
          </ul>
          <div class="panel-body"><?= $form->field($modelpembayaran, 'id_metode')->dropDownList($metode_bayar,['class'=>'edited form-control','value'=>$session['pembayaran.id_metode']])?>
</div>


</div>
</div>





<center>
<div class="form-group col-md-12">
<div id="setuju"><?= Html::checkbox('Setuju', $checked = false,['id'=>'cekbox']); ?> Saya Setuju Dengan <?= Html::a('Persyaratan Dan ketentuan', '#Sayarat'); ?>  Istana Travel<br></div>
<?= Html::button('',['class'=>'btn btn-lg btn-primary glyphicon glyphicon-pencil','id'=>'btn-edit']); ?>
<?= Html::button('',['class'=>'btn btn-lg btn-primary glyphicon glyphicon-ok','id'=>'btn-ok']); ?>
<?= Html::submitButton(Yii::t('app', 'CONFIRM'), ['class' => 'btn btn-lg btn-danger disabled','disabled'=>true,'id'=>'btn-confirm']) ?>

    </div>
</center>

    



<?php ActiveForm::end();?>

</div>
<div class="panel-footer panel-primary"> Copyright &copy Istana Travel</div>
</div>