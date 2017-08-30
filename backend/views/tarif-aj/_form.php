<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\TarifAj */
/* @var $form yii\widgets\ActiveForm */
?>
<?php

$model->isNewRecord ? $model->id_jenis_tarif = 1 : Yii::t('app', 'Update');

$this->registerJs("
$(document).ready(function(){
     var rad = $('input:radio:checked').val();
            if (rad == '1') {
               $('#div-pax').show();
               $('#div-car').show();
            }else if(rad == '2'){
                $('#div-car').hide();
                $('#div-pax').show();
            }else if(rad == '3'){
                $('#div-car').show();
                $('#div-pax').hide();
            }
});
$('#drop-lokasi').on('change',function(){
  var lokasi = $('#drop-lokasi').val();


      $('#div-lokasi').show(500);
      $('#btn_submit').attr('disabled',true);
      $.post( '".Yii::$app->urlManager->createUrl('/tarif-aj/area?id_lokasi=')."'+lokasi,
      function( data ) {
      $('select#drop-area').html( data );
      });


});
")?>
<div class="tarif-aj-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_destinasi')->widget(Select2::classname(), [
                'data' => $Destinasi,
                // 'language' => 'de',
                'options' => ['placeholder' => 'Pilih Destinasi'],
                'pluginOptions' => [
                'allowClear' => true,
                 //'tags' => true,
                ],
                ]);
       ?>

       <?= $form->field($model, 'id_lokasi')->dropDownList(
            $Lokasi,           // Flat array ('id'=>'label')
            ['prompt'=>' Pilih Area','id'=>'drop-lokasi']    // options
        );?>

    <?= $form->field($model, 'id_area')->widget(Select2::classname(), [
                'data' => $Area,
                // 'language' => 'de',
                'options' => ['placeholder' => 'Pilih Lokasi','id'=>'drop-area'],
                'pluginOptions' => [
                'allowClear' => true,
                 //'tags' => true,
                ],
                ]);
       ?>

    <?= $form->field($model, 'id_jenis_tarif')->radioList(['1'=>'Sharing & Private','2'=>'Sharing','3'=>'Private'],[
            'inline'=>true,
            'onchange'=>'
            var rad = $("input:radio:checked").val();
            if (rad == "1") {
               $("#div-pax").show(500);
               $("#div-car").show(500);
            }else if(rad == "2"){
                $("#div-car").val();
                $("#div-car").hide(500);
                $("#div-pax").show(500);
            }else if(rad == "3"){
                $("#div-car").show(500);
                $("#div-pax").val();
                $("#div-pax").hide(500);
            }else{
                alert("Something is Wrong");
            }',
            ]); ?>

    <div id="div-pax"><?= $form->field($model, 'tarif_pax')->textInput(['id'=>'form-pax']) ?></div>

    <div id="div-car">
    <?= $form->field($model, 'tarif_car')->textInput(['id'=>'form-car']) ?>
    <?= $form->field($model, 'tarif_elf')->textInput(['id'=>'form-car']) ?>
      
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
