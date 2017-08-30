<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\TimePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\WaktuJemput */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="waktu-jemput-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="col-md-12">
 <div class="col-md-3"><?= $form->field($model, 'id_destinasi')->widget(Select2::classname(), [
                'data' => $Destinasi,
                // 'language' => 'de',
                'options' => ['placeholder' => 'Pilih Destinasi'],
                'pluginOptions' => [
                'allowClear' => true,
                 //'tags' => true,
                ],
                ]);
       ?></div>
<div class="col-md-3"><?= $form->field($model, 'id_lokasi_aj')->widget(Select2::classname(), [
                'data' => $Lokasi,
                // 'language' => 'de',
                'options' => ['placeholder' => 'Pilih Lokasi'],
                'pluginOptions' => [
                'allowClear' => true,
                 //'tags' => true,
                ],
                ]);
       ?></div>
   </div>

   <div class="col-md-12">
 <div class="col-md-3"> <?= $form->field($model, 'start_time')->widget(TimePicker::classname(), [
            'pluginOptions' => [
       // 'showSeconds' => true,
        'showMeridian' => false,
        'minuteStep' => 15,
        //'secondStep' => 5,
    ]
    ]); ?>

    </div>
<div class="col-md-3"><?= $form->field($model, 'end_time')->widget(TimePicker::classname(), [
            'pluginOptions' => [
       // 'showSeconds' => true,
        'showMeridian' => false,
        'minuteStep' => 15,
        //'secondStep' => 5,
    ]
    ]); ?></div>
   </div>

    <div class="form-group col-md-12">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
