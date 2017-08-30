<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\TSesiBiaya */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tsesi-biaya-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($modelSesi, 'id_destinasi')->widget(Select2::classname(), [
                'data' => $Destinasi,
                // 'language' => 'de',
                'options' => ['placeholder' => 'Pilih Destinasi'],
                'pluginOptions' => [
                'allowClear' => true,
                 //'tags' => true,
                ],
                ]);
       ?>
    <?= $form->field($modelSesi, 'id_jenis_sesi')->dropDownList($jenisSesi,['prompt' => 'Pilih Jenis Sesi']);?>

    <?= $form->field($modelSesi, 'tgl_mulai')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Tanggal Awal Sesi'],
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

    <?= $form->field($modelSesi, 'tgl_selesai')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Tanggal Akhir Sesi'],
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
        <?= Html::submitButton($modelSesi->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $modelSesi->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
