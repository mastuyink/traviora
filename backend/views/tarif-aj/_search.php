<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Caritarif */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tarif-aj-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_destinasi') ?>

    <?= $form->field($model, 'id_area') ?>

    <?= $form->field($model, 'id_jenis_tarif') ?>

    <?= $form->field($model, 'id_trans') ?>

    <?php // echo $form->field($model, 'tarif_pax') ?>

    <?php // echo $form->field($model, 'tarif_car') ?>

    <?php // echo $form->field($model, 'datetime') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
