<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\label\LabelInPlace;

/* @var $this yii\web\View */
/* @var $model app\models\TSupplier */
/* @var $form yii\widgets\ActiveForm */
 $config = ['template'=>"{input}\n{error}\n{hint}"];
?>

<div class="tsupplier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama',$config)->widget(LabelInPlace::classname(),[
               'defaultIndicators'=>false,
               'encodeLabel'=> false]
               ); ?>

    <?= $form->field($model, 'alamat',$config)->widget(LabelInPlace::classname(),[
               'defaultIndicators'=>false,
               'encodeLabel'=> false]
               ); ?>

    <?= $form->field($model, 'no_telp',$config)->widget(LabelInPlace::classname(),[
               'defaultIndicators'=>false,
               'encodeLabel'=> false]
               ); ?>
    <?= $form->field($model, 'email',$config)->widget(LabelInPlace::classname(),[
               'defaultIndicators'=>false,
               'encodeLabel'=> false]
               ); ?>

    <?= $form->field($model, 'site',$config)->widget(LabelInPlace::classname(),[
               'defaultIndicators'=>false,
               'encodeLabel'=> false,
               'label'=>'Situs Web ( Optional )']
               ); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
