<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */

$this->title = 'Pickup / Drop off ';
echo "<----- AREA JEMPUT".var_dump($session['jemput.id_area']);
echo " <--- ID JAM JEMPUT------".var_dump($session['jemput.id_jam_jemput']);
echo " <--- JEMPUT BIAYA------".var_dump($session['jemput.biaya']);
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
//echo " --- ANTAR CAR".var_dump($session['antar.tarif_car']);
$this->registerJs("
$(document).ready(function(){
   $('#drop-jemput').val(1);
   $('#drop-antar').val(1);
   $('#btn-submit').prop('disabled', false);
   $('#btn-submit').removeClass('disabled');
   $('#btn-submit').addClass('active');
});

function TestAntar(){
    var dropA   = $('#drop-antar').val();
    var testAA  = $('#tantar-nama_area').val();
    var telpA   = $('#telp-jemput').val();
    var alamatA = $('#alamat-jemput').val();

    if (dropA > 1) {
      if ( testAA == '' || telpA == '' || alamatA == '' || telpA < 1 ) {
          offButton();
        }else{
          onButton();
         }
    }else{
          onButton();
      }  
};

function TestJemput(){
   var dropJ   = $('#drop-jemput').val();
    var testAJ  = $('#tjemput-nama_area').val();
    var telpJ   = $('#telp-jemput').val();
    var alamatJ = $('#alamat-jemput').val();
    if (dropJ > 1) {
      if ( testAJ == '' || telpJ == '' || alamatJ == '' || telpJ < 1 ) {
          offButton();
        }else{
          onButton();
         }
    }else{
          onButton();
      }
}

function onButton(){
  $('#btn-submit').prop('disabled', false);
  $('#btn-submit').removeClass('disabled');
  $('#btn-submit').addClass('active');
};

function offButton(){
  $('#btn-submit').prop('disabled', true);
  $('#btn-submit').removeClass('active');
  $('#btn-submit').addClass('disabled');
};

$('.isian-jemput').blur(function(){
   TestJemput();
  });

$('.isian-antar').blur(function(){
   TestAntar();
  });

$('#drop-jemput').on('change',function(){
  var jemput = $('#drop-jemput').val();
  if (jemput == 1) {
        $('#div-jemput').hide(500);
        onButton();
  } else {
       $('#div-jemput').show(500);
       offButton();
       $.post( '".Yii::$app->urlManager->createUrl('/booking/area?id_lokasi=')."'+jemput,
         function( data ) {
         $('select#tjemput-nama_area').html( data );
         });

       $.ajax({
          url : '".Url::to(["pickup-time"])."',
          type: 'POST',
          data: {idl: jemput},
          success: function (time) {
          $('#pickup-time').html(time);
          },
        });
      TestJemput();
  }

});

$('#drop-antar').on('change',function(){
  var antar = $('#drop-antar').val();
  if (antar == 1) {
    $('#div-antar').hide(500);
    onButton();
  } else {
      $('#div-antar').show(500);
      offButton();
      $.post( '".Yii::$app->urlManager->createUrl('/t-booking/area?id_lokasi=')."'+antar,
        function( data ) {
        $('select#tantar-nama_area').html( data );
        });
      TestAntar();
   }

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
         <div class="panel-heading">PENJEMPUTAN ( PICKUP )</div>
            <div class="panel-body">

                <?= $form->field($modeljemput, 'lokasi_jemput')->dropDownList($listAJ,[
                  'id'=>'drop-jemput']);?>

                <div id="div-jemput" style="display: none;">
                <?= $form->field($modeljemput, 'nama_area')->widget(Select2::classname(), [
                //'data' => $areaAJ,

                // 'language' => 'de',
                'options' => ['placeholder' => 'Lokasi Sekitar',],
                'pluginOptions' => [
                'allowClear' => true,
                 'tags' => true,
                ],
                'pluginEvents' => [
                "change" => "function() {
                  $('#radio-metode').attr('checked',false);
                 var arj = $(this).val();
                 var vlj = $('#drop-jemput').val();
                 if(arj != ''){
                   $.ajax({
                     url : '".Url::to(["extra-pickup"])."',
                     type: 'POST',
                     data: {ida: arj, idl: vlj},
                     success: function (div) {
                     $('#radio-dual').html(div);

                     },
                   });
                   TestJemput();
                 }else{
                   $('#radio-dual').html('Pilih Tempat / Lokasi Sekitar');
                   offButton();
                  }


                 }",
                ],
                ]);
                 ?>

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
      <div class="panel-heading">PENGATARAN ( DROP OFF )</div>
         <div class="panel-body">

                <?= $form->field($modelAntar, 'lokasi_antar')->dropDownList($listAJ,['id'=>'drop-antar']);?>

                <div id="div-antar" style="display: none;">
                <?= $form->field($modelAntar, 'nama_area')->widget(Select2::classname(), [
                'data' => $areaAJ,

                // 'language' => 'de',
                'options' => ['placeholder' => 'Lokasi Sekitar',],
                'pluginOptions' => [
                'allowClear' => true,
                 'tags' => true,
                ],
                'pluginEvents' => [
                "change" => "function(){
                 var ara = $(this).val();
                 var vla = $('#drop-antar').val();
                 if(ara != ''){
                   $.ajax({
                     url : '".Url::to(["extra-drop"])."',
                     type: 'POST',
                     data: {ida: ara, idl: vla},
                     success: function (div) {
                     $('#radio-dual-antar').html(div);
                     },
                   });
                   TestAntar();
                }else{
                   $('#radio-dual-antar').html('Masukkan Lokasi Sekitar');
                   offButton();
                  }

                 }",
                ],
                ]);
                 ?>
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

