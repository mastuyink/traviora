<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TSesiBiayaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tsesi-biaya-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_destinasi') ?>

    <?= $form->field($model, 'id_jenis_sesi') ?>

    <?= $form->field($model, 'tgl_mulai') ?>

    <?= $form->field($model, 'tgl_selesai') ?>

    <?php // echo $form->field($model, 'id_biaya') ?>

    <?php // echo $form->field($model, 'datetime') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
