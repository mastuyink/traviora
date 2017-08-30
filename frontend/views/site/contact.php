<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\label\LabelInPlace;
use yii\captcha\Captcha;

$this->title = 'Contact Us';
$this->params['breadcrumbs'][] = $this->title;
$config = ['template'=>"{input}\n{error}\n{hint}"];
?>


<div class="container site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Please fill the form below, we will process your request as soon as possible
    </p>

    <div class="row">
        <div class="col-md-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
            <?= $form->field($model, 'link')->textInput(['style'=>'display:none'])->label('') ?>

                <?= $form->field($model, 'name',$config)->widget(LabelInPlace::classname(),
                [
                'defaultIndicators'=>false,
                'pluginOptions'=>[
                    'encodeLabel'=> false,
                    'label'=>'Nama',
                    'defaultIndicators'=>false
                    ]
                ]
                ); 
                ?>

                <?= $form->field($model, 'email',$config)->widget(LabelInPlace::classname(),
                [
                'defaultIndicators'=>false,
                'pluginOptions'=>[
                    'encodeLabel'=> false,
                    'label'=>'Nama',
                    'defaultIndicators'=>false
                    ]
                ]
                ); 
                ?>

                <?= $form->field($model, 'subject',$config)->widget(LabelInPlace::classname(),
                [
                'defaultIndicators'=>false,
                'pluginOptions'=>[
                    'encodeLabel'=> false,
                    'label'=>'Nama',
                    'defaultIndicators'=>false
                    ]
                ]
                ); 
                ?>



                <?= $form->field($model, 'body',$config)->widget(LabelInPlace::classname(),
                [
                'defaultIndicators'=>false,
                 'type' => LabelInPlace::TYPE_TEXTAREA,
                ]
                ); 
                ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-md-6">{input}</div><div class="col-md-3">{image} </div></div>Click Text Image To Reload Chapta',
                ])->label('Chaptha') ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
