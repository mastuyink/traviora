<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;

/* @var $this yii\web\View */
 
               
               
$this->title = 'Pickup / Drop off ';
//var_dump($session['currency.round_kurs']);
/*echo "<----- Dewasa -------".var_dump($session['booking.dewasa']);
echo " <--- Anak------".var_dump($session['booking.anak']);
echo " <--- Bayi ------".var_dump($session['booking.bayi']);
echo " <--- Pickup pax ------".var_dump($session['booking.dewasa']+$session['booking.anak']);
echo " <--- Total pax ------".var_dump($session['booking.dewasa']+$session['booking.anak']+$session['booking.bayi']);
echo " <--- JEMPUT METODE------".var_dump($session['jemput.metode']);
echo " <--- ANTAR BIAYA------".var_dump($session['antar.biaya']);
echo " <--- ANTAR METODE------".var_dump($session['antar.metode']);
echo " <--- NEW AREA------".var_dump($session['area.id_area']);
echo "<<< ID DESTINASI ".var_dump($session['destinasi.id_destinasi']);
echo "<< metode bayar <br>".var_dump($session['pembayaran.id_metode']);
echo "<< ID_lokasi".var_dump($session['jemput.lokasi_jemput']);
?>
<br>
<?php
$vat = 10/10;
echo "<br> Dinaikkan Terus  / 1 = ".ceil($vat);
echo "<br> Test Naik= ".round($vat,0,PHP_ROUND_HALF_UP);
echo "<br> Test Turun= ".round($vat,0,PHP_ROUND_HALF_DOWN);
echo "<br> Asli = ".$vat."<br><br>";
var_dump($session['jemput.biaya']);*/
//echo " --- ANTAR CAR".var_dump($session['antar.tarif_car']);
$this->registerJs("
$(document).ready(function(){
   $('#btn-submit').prop('disabled', false);
   $('#btn-submit').removeClass('disabled');
   $('#btn-submit').addClass('active');
});


");

?>




 <div class="col-lg-12">
    <div class="pickup-dropoff-form-form">
      <?php $form = ActiveForm::begin([
    'options' => [
        'id' => 'pickup-dropoff-form'
    ]
]);
?>

    <div class="col-md-6">
      <div class="panel panel-primary">
         <div class="panel-heading">PICKUP</div>
            <div class="panel-body">
                  <?= $form->field($modeljemput, 'nama_area')->widget(Select2::classname(), [
                 'data' => $areaAJ,

                // 'language' => 'de',
                'options' => ['placeholder'=>'I Dont Need Pickup','id'=>'drop-jemput'],
                'pluginOptions' => [
                'allowClear' => true,
                // 'tags' => true,
                ],
                'pluginEvents' => [
                "select2:select" => "function() {
                   $('#div-jemput').show(500);
                  $('#radio-metode').attr('checked',false);
                 var arj = $(this).val();
              
                   $.ajax({
                     url : '".Url::to(["extra-pickup"])."',
                     type: 'POST',
                     data: {ida: arj},
                     success: function (div) {
                     $('#radio-dual').html(div);

                     },
                   });
                 

                   $.ajax({
                   url : '".Url::to(["pickup-time"])."',
                   type: 'POST',
                   data: {idl: arj},
                   success: function (time) {
                         $('#pickup-time').html(time);
                         },
                   });
                    }",
                  "select2:unselect" => "function() { 
                       $('#div-jemput').hide(500);
                       $('.isian-jemput').val('');
                     
                   }",
                ],
                ])->label('Location'); 
                 ?>
                
                <div id="div-jemput" style="display: none;">
                

                <?= $form->field($modeljemput, 'alamat_jemput')->textInput(['placeholder'=>'Alamat Pickup','class'=>'form-control isian-jemput','id'=>'alamat-jemput','aria-required'=>true]) ?>
                <?= $form->field($modeljemput, 'no_telp_jemput')->textInput(['placeholder'=>'No Telp Hotel / lokasi Pickup','class'=>'form-control isian-jemput','id'=>'telp-jemput']) ?>

                <ul class="list-group">
                    <li class="list-group-item" id="radio-dual"></li>

                    <li class="list-group-item" id="pickup-time"><h5></h5></li>

                </ul>

                </div>




            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-primary">
      <div class="panel-heading">DROP OFF</div>
         <div class="panel-body">

                 <?= $form->field($modelAntar, 'nama_area')->widget(Select2::classname(), [
                'data' => $areaAJ,

                // 'language' => 'de',
                'options' => ['placeholder' => 'I Dont Need Drop Off','id'=>'drop-antar'],
                'pluginOptions' => [
                'allowClear' => true,
                 //'tags' => true,
                ],
                'pluginEvents' => [
                "select2:select" => "function(){
                   $('#div-antar').show(500);
                 var ara = $(this).val();
                  offButton();
                   $.ajax({
                     url : '".Url::to(["extra-drop"])."',
                     type: 'POST',
                     data: {ida: ara},
                     success: function (div) {
                     $('#radio-dual-antar').html(div);
                     },
                   });

                 }",
                  "select2:unselect" => "function() { 
                       $('#div-antar').hide(500);
                       $('.isian-antar').val('');
                     
                   }",
                ],
                ])->label('Location');
                 ?>
               

                <div id="div-antar" style="display: none;">

                <?= $form->field($modelAntar, 'alamat_antar')->textInput(['placeholder'=>'Alamat Drop Off','class'=>'form-control isian-antar','id'=>'alamat-antar']) ?>
                <?= $form->field($modelAntar, 'no_telp_antar')->textInput(['placeholder'=>'No Telp Hotel / Lokasi Drop off','class'=>'form-control isian-antar','id'=>'telp-antar']) ?>
                <ul class="list-group">
                     <li class="list-group-item" id="radio-dual-antar"></li>
                    <li class="list-group-item">-</li>

                </ul>

                </div>

          </div>
        </div>
    </div>
        <div class="form-group">
                 <?= Html::submitButton(Yii::t('app', 'NEXT-STEP'), ['class' => 'btn btn-lg btn-block btn-warning disabled','disabled'=>true,'id'=>'btn-submit']) ?>
            </div>

            <?php ActiveForm::end(); ?>

  </div>

</div>

