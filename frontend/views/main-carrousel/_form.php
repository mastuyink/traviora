<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\TMainCarrousel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tmain-carrousel-form">

    <?php $form = ActiveForm::begin([
     'options'=>['enctype'=>'multipart/form-data'] // important
]); ?>


    <?= $form->field($model, 'carrousel', ['options' => ['class' => 'form-group col-md-12']])->widget(FileInput::classname(), [
    'options' => ['multiple' => false, 'accept' => 'image/*'],
    'pluginOptions' => ['previewFileType' => 'image']
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
