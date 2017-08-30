<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\TLimitDestinasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tlimit-destinasi-form">

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

    <?= $form->field($model, 'event_limit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_limit')->widget(DatePicker::classname(), [
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

    <?= $form->field($model, 'jumlah_limit')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Tambah') : Yii::t('app', 'Simpan'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
