<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TBooking */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbooking-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_destinasi')->textInput() ?>

    <?= $form->field($model, 'id_customer')->textInput() ?>

    <?= $form->field($model, 'tgl_trip')->textInput() ?>

    <?= $form->field($model, 'waktu_booking')->textInput() ?>

    <?= $form->field($model, 'waktu_exp')->textInput() ?>

    <?= $form->field($model, 'total_pax')->textInput() ?>

    <?= $form->field($model, 'biaya_trip')->textInput() ?>

    <?= $form->field($model, 'biaya_jemput')->textInput() ?>

    <?= $form->field($model, 'biaya_antar')->textInput() ?>

    <?= $form->field($model, 'total_biaya')->textInput() ?>

    <?= $form->field($model, 'id_status')->textInput() ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
