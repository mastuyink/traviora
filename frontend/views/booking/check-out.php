<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
$this->title = 'CHECK OUT';
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
  $('#div-detail').toggle('1000');
   
});




");

?>



<div class="panel panel-primary">
<div class="panel-heading"><center><h3>CONFIRM YOUR DATA</h3></center></div>
<div class="panel-body">
<?php $form = ActiveForm::begin([]);?>
  <div class="col-md-4">
  <div class="panel panel-primary">
  <div class="panel-heading">TRIP DETAIL</div>
    <ul class="list-group">
      <li class="list-group-item">Name Of Trip <strong class="pull-right"><?= $session['destinasi.nama_destinasi'] ?> </strong> </li>
            <li class="list-group-item">Date Of Trip<strong class="pull-right"><?= date('d-m-Y', strtotime($session['booking.tgl_trip'])) ?></strong> </li>
            <li class="list-group-item">Number Of Pax <strong class="pull-right"> <?= $session['booking.total_pax']?> Pax </strong></li>

    </ul>
          <div class="panel-body">
          <?= Html::button('Name Detail', ['class' => 'btn btn-sm btn-block btn-info','id'=>'btn-detail']); ?>
          </div>
  </div>
  </div>

      <div class="col-md-4">
      <div class="panel panel-primary">
      <div class="panel-heading">PAX DETAIL</div>
      
          <ul class="list-group">
            <li class="list-group-item">Adult Traveler <strong class="pull-right"><?= $session['traveler.jml_dewasa']?> Pax </strong></li>
            <li class="list-group-item">Child Traveler<strong class="pull-right"><?= $session['traveler.jml_anak']?> Pax</strong></li>
            <li class="list-group-item">Infant Traveler<strong class="pull-right"><?= $session['traveler.jml_bayi']?> Pax</strong></li>

          </ul>
          </div>
      </div>


<div class="col-md-4">
<div class="panel panel-primary">
      <div class="panel-heading">LEADER DETAIL</div>
         <div class="panel-body">
<?= $form->field($modelCustomer, 'nama_customer')->textInput(['class'=>'edited form-control','value'=>$session['customer.nama_customer']]) ?>
<?= $form->field($modelCustomer, 'email')->textInput(['class'=>'edited form-control','value'=>$session['customer.email']]) ?>
<?= $form->field($modelCustomer, 'no_telp')->textInput(['class'=>'edited form-control','value'=>$session['customer.telp']]) ?>
</div>
</div>
</div>
<div id="div-detail" class="col-md-12" style="display: none;">
     
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
  <div class="col-md-12">    
<div class="col-md-6">
<div class="panel panel-primary">
<div class="panel-heading">PICKUP</div>
    <ul class="list-group">
    <?php 
    if ($Areajemput !== null) {
      echo "<li class='list-group-item'>Area<strong class='pull-right'>". $Areajemput->idLokasiAj->lokasi_aj ."</strong></li>
            <li class='list-group-item'>Address / Hotel Location <strong class='pull-right'>". $Areajemput->nama_area ."</strong></li>
            <li class='list-group-item'>Detail Address<strong class='pull-right'>". $session['jemput.alamat_jemput'] ."</strong></li>
            <li class='list-group-item'>Phone Number<strong class='pull-right'>". $session['jemput.no_telp_jemput'] ."</strong></li>";
          if ($metode_jemput !== null && $metode_jemput->id == 2) {
                    echo "<li class='list-group-item'> Method <strong class='pull-right'>".$metode_jemput->jenis_tarif."</strong></li>
                       <li class='list-group-item'> Charge <strong class='pull-right'>".$session['currency.id']." ". $session['jemput.biaya'] ."</strong></li>";
                 }elseif ($metode_jemput !== null && $metode_jemput->id == 3) {
                    echo "<li class='list-group-item'> Method <strong class='pull-right'>".$metode_jemput->jenis_tarif."</strong></li>
                       <li class='list-group-item'>Charge <strong class='pull-right'>".$session['currency.id']." ". $session['jemput.biaya'] ." / Car</strong></li>";
                 }else{
                    echo "<li class='list-group-item'> Method <strong class='pull-right'> Will Be Notified Later </strong></li>
                        <li class='list-group-item'> Charge <strong class='pull-right'> Will Be Notified Later </strong></li>";
                  }
              if ($waktu_jemput == null) {
                echo "<li class='list-group-item'> Time <strong class='pull-right'>Pickup time will be notified later</strong></li>";
              }else{
              echo "<li class='list-group-item'>Pickup Time <strong class='pull-right'>".$waktu_jemput->start_time." - ".$waktu_jemput->end_time."</strong></li>";
              }
    }else{
      echo "<li class='list-group-item'>Area<strong class='pull-right'>No Pickup</strong></li>";
      } ?>
            
            
            
            

          </ul>
</div>
</div>

<div class="col-md-6">
<div class="panel panel-primary">
      <div class="panel-heading">DROP OFF</div>

              <ul class="list-group">
              <?php 
              if ($AreaAntar !== null) {
                echo "<li class='list-group-item'>Area<strong class='pull-right'>". $AreaAntar->idLokasiAj->lokasi_aj ."</strong></li>
                    <li class='list-group-item'>Address / Hotel Location <strong class='pull-right'>". $AreaAntar->nama_area ."</strong></li>
                    <li class='list-group-item'>Detail Address<strong class='pull-right'>". $session['antar.alamat_antar'] ."</strong></li>
                    <li class='list-group-item'>Phone Number<strong class='pull-right'>". $session['antar.no_telp_antar'] ."</strong></li>";
                  if ($metode_antar !== null && $metode_antar->id == 2) {
                    echo "<li class='list-group-item'>Method<strong class='pull-right'>".$metode_antar->jenis_tarif."</strong></li>
                       <li class='list-group-item'>Charge<strong class='pull-right'>".$session['currency.id']." ". $session['antar.biaya'] ." </strong></li>
                       <li class='list-group-item'>-<strong class='pull-right'>-</strong></li>";
                 }elseif ($metode_antar !== null && $metode_antar->id == 3) {
                    echo "<li class='list-group-item'>Method<strong class='pull-right'>".$metode_antar->jenis_tarif."</strong></li>
                       <li class='list-group-item'>Charge <strong class='pull-right'>".$session['currency.id']." ".$session['antar.biaya']."</strong></li>
                       <li class='list-group-item'>-<strong class='pull-right'></strong></li>";
                 }else{
                    echo "<li class='list-group-item'>Method<strong class='pull-right'> Will Be Notified Later </strong></li>
                        <li class='list-group-item'>Charge<strong class='pull-right'> Will Be Notified Later </strong></li>
                        <li class='list-group-item'>-<strong class='pull-right'>-</strong></li>";
                  }
              }else{
              echo "<li class='list-group-item'>Area<strong class='pull-right'>No Drop Off</strong></li>";
              } ?>
           
            
            
            
              

          </ul>
        
</div>
</div>
</div>
<div class="panel-heading"><center><h3><strong>COST DETAILS</strong></h3></center></div>

<div class="col-md-4">
<div class="panel panel-primary">
      <div class="panel-heading">PICKUP & DROP OFF</div>
         <ul class="list-group">
            <li class="list-group-item">Pickup Charge<strong class="pull-right"><?= "".$session['currency.id']." ".$session['jemput.biaya']?></strong></li>
            <li class="list-group-item">Drop Off Charge<strong class="pull-right"><?= "".$session['currency.id']." ".$session['antar.biaya']?></strong></li>
            <li class="list-group-item">Total Pickup & Drop off Charges<strong class="pull-right"><?= "".$session['currency.id']." ".number_format($session['jemput.biaya'] + $session['antar.biaya'],2)?></strong></li>

          </ul>



</div>
</div>

<div class="col-md-4">
<div class="panel panel-primary">
      <div class="panel-heading">TRIP COST</div>
        
          <ul class="list-group">
            <li class="list-group-item">Adult trip cost<strong class="pull-right"><?= "".$session['currency.id']." ".$session['booking.biaya_dewasa']?></strong></li>
            <li class="list-group-item">Child trip cost<strong class="pull-right"><?= "".$session['currency.id']." ".$session['booking.biaya_anak']?></strong></li>
            <li class="list-group-item">Infant trip cost<strong class="pull-right"><?= "".$session['currency.id']." ".$session['booking.biaya_bayi']?></strong></li>
            <li class="list-group-item">Total trip cost<strong class="pull-right"><?= "".$session['currency.id']." ".number_format($session['booking.biaya_dewasa']+$session['booking.biaya_anak']+$session['booking.biaya_bayi'],2)?></strong></li>

          </ul>


</div>
</div>


<div class="col-md-4">
<div class="panel panel-primary">
      <div class="panel-heading">TOTAL BIAYA</div>
   <ul class="list-group">
            <li class="list-group-item">Cost trip<strong class="pull-right"><?= "".$session['currency.id']." ".number_format($session['booking.biaya_dewasa']+$session['booking.biaya_anak']+$session['booking.biaya_bayi'],2)?></strong></li>
            <li class="list-group-item">Cost Pickup & Drop Off<strong class="pull-right"><?= "".$session['currency.id']." ".number_format($session['jemput.biaya'] + $session['antar.biaya'],2)?></strong></li>
            <li class="list-group-item"><strong>Total tagihan</strong><strong class="pull-right"><?= "".$session['currency.id']." ".number_format($session['booking.biaya_trip']+$session['jemput.biaya']+$session['antar.biaya'],2)?></strong></li>
            
          </ul>
         


</div>
</div>





<center>
<div class="form-group col-md-12">
<div id="setuju">
<?= Html::checkbox('Setuju', $checked = false,['id'=>'cekbox']); ?>
 I agree to the
<?= Html::a('terms and conditions',['term-service','name'=>'term'],['data-toggle'=>"modal",
                                                    'data-target'=>"#TermModal",
                                                    'data-title'=>"Term & Condition",
                                                    ]); ?>  Indo Gateway<br></div>
<?= Html::button('',['class'=>'btn btn-lg btn-primary glyphicon glyphicon-pencil','id'=>'btn-edit']); ?>
<?= Html::button('',['class'=>'btn btn-lg btn-primary glyphicon glyphicon-ok','id'=>'btn-ok']); ?>
<?= Html::submitButton(Yii::t('app', 'CONFIRM'), ['class' => 'btn btn-lg btn-danger disabled','disabled'=>true,'id'=>'btn-confirm']) ?>

    </div>
</center>

    



<?php ActiveForm::end();?>

</div>
<div class="panel-footer panel-primary"> Copyright &copy Indo Gateway</div>
</div>

<?php
Modal::begin([
    'id' => 'TermModal',
    'header' => '<h4 class="modal-title">Term & Service</h4>',
]);
 
echo '';
 
Modal::end();

$this->registerJs("
    $('#TermModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        var title = button.data('title') 
        var href = button.attr('href') 
        modal.find('.modal-title').html(title)
        modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>')
        $.post(href)
            .done(function( data ) {
                modal.find('.modal-body').html(data)
            });
        })
");

?>