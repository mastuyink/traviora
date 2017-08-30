<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $modelKhusus app\modelKhususs\TBiayaKhusus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbiaya-khusus-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($modelKhusus, 'id_destinasi')->widget(Select2::classname(), [
                'data' => $Destinasi,
                // 'language' => 'de',
                'options' => ['placeholder' => 'Pilih Destinasi'],
                'pluginOptions' => [
                'allowClear' => true,
                 //'tags' => true,
                ],
                ]);
       ?>

    <?= $form->field($modelKhusus, 'event')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelKhusus, 'tgl_event')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Pilih Tanggal'],
   // 'readonly' => true,
    'pickerButton' => false,
    //'size'=>'sm',
    'pluginOptions' => [
        'autoclose'=>true,
       // 'startDate' =>$mx ,
       // 'endDate' => date('Y-m-d', strtotime('+1 year', time())),
        'todayHighlight' => false,
        'format' => 'yyyy-mm-dd'
    ]
    ]); ?>
    <?= $form->field($modelBiaya, 'biaya_dewasa')->textInput() ?>
    <?= $form->field($modelBiaya, 'biaya_anak')->textInput() ?>
    <?= $form->field($modelBiaya, 'biaya_bayi')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($modelKhusus->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $modelKhusus->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
