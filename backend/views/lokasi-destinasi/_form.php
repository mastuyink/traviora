<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LokasiDestinasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lokasi-destinasi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lokasi')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
