<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\form\ActiveField;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\TPost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tpost-form">

    <?php $form = ActiveForm::begin([
     'options'=>['enctype'=>'multipart/form-data'] // important
]); ?>

    <?= $form->field($model, 'id_destinasi', ['options' => ['class' => 'form-group col-md-12']])->widget(Select2::classname(), [
                'data' => $destinasi,
                'options' => ['placeholder' => 'Pilih Destinasi'],
                'pluginOptions' => [
                'allowClear' => true,
                 
                ],
                'pluginEvents' => [
                "change" => "function() {
                     var dst = $('select option:selected').text();
                     $.ajax({
                     url : '".Url::to(["slug"])."',
                     type: 'POST',
                     data: {dest: dst},
                     success: function (div) {
                     $('#tpost-slug').val(div);

                     },
                   });
               }",
                           
                
                ]
                ]);
                 ?>
    <?= $form->field($model, 'slug', [
    'options' => ['id'=>'form-slug','class' => 'form-group col-md-12','placeholder' => 'Pilih Destinasi'],
    'hintType' => ActiveField::HINT_SPECIAL,
    'hintSettings' => ['placement' => 'right', 'onLabelClick' => true, 'onLabelHover' => false]
   ])->textInput()->hint('text yang Akan Di tampilkan Pada Url, Pisahkan Setiap Kata Dengan tanda Strip <strong>-</strong>');?>

   <?=  $form->field($model, 'thumbnail', ['options' => ['class' => 'form-group col-md-12','placeholder' => 'Pilih Destinasi']])->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*'],
    ]); ?>
    <?= $form->field($model, 'carrousel[]', ['options' => ['class' => 'form-group col-md-12']])->widget(FileInput::classname(), [
    'options' => ['multiple' => true, 'accept' => 'image/*'],
    'pluginOptions' => ['previewFileType' => 'image']
    ]); ?>

    <?= $form->field($model, 'content', ['options' => ['class' => 'form-group col-md-12']])->widget(\yii\redactor\widgets\Redactor::className(),[
       
        'clientOptions' => [
        'imageManagerJson' => ['/redactor/upload/image-json'],
        'imageUpload' => ['/redactor/upload/image'],
        'fileUpload' => ['/redactor/upload/file'],
        'lang' => 'en',
        'plugins' => ['clips', 'fontcolor','imagemanager'],
        
    ]]) ?>


    <div class="form-group col-md-12">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-lg btn-success' : 'btn btn-lg btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
