<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TTransport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ttransport-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_transport')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_jenis_trans')->textInput() ?>

    <?= $form->field($model, 'last_edit')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
