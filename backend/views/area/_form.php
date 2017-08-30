<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AreaAj */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="area-aj-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_lokasi_aj')->dropDownList(
            $lokasi,           // Flat array ('id'=>'label')
            ['prompt'=>' Pilih Area']    // options
        );?>

    <?= $form->field($model, 'nama_area')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
