<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\validasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="validasi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_destinasi')->dropDownList(
            $destinasi,           // Flat array ('id'=>'label')
            ['prompt'=>' Pilih Jenis Destinasi']    // options
        );?>

    <?= $form->field($model, 'judul_content')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className()) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
