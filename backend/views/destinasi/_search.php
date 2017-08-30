<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $searchModel app\searchModels\TDestinasiSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
 
$this->registerJs("
    $('document').ready(function(){ 
        $('#form-booking').on('pjax:end', function() {
            $.pjax.reload({
                container:'#grid-booking',
            });
        });
    });"
);
?>
<div class="tdestinasi-search">
<?php yii\widgets\Pjax::begin(['id' => 'form-booking']) ?>
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true ]]); ?>

    <div class="col-md-4"><?= $form->field($searchModel, 'id_jenis_destinasi')->dropDownList($jenisd,['prompt'=>' Pilih Jenis Destinasi']);?></div>

    <div class="col-md-4"><?= $form->field($searchModel, 'nama_destinasi')->widget(Select2::classname(), [
                'data' => $Des,
                // 'language' => 'de',
                'options' => ['placeholder' => 'nama Destinasi'],
                'pluginOptions' => [
                'allowClear' => true,
                // 'tags' => true,
                ],
                ]);
       ?></div>
<div class="col-md-4"><?= $form->field($searchModel, 'id_status')->widget(SwitchInput::classname(), [
    'options'=>['uncheck' => 2,'value'=>1,],
    'type' => SwitchInput::CHECKBOX,
   // 'tristate' => true,
    //'indeterminateValue' => null, // set indeterminate as -1 default is null
   // 'indeterminateToggle' => ['label'=>'&lt;i class="glyphicon glyphicon-remove-sign">&lt;/i>'],
    ]);?></div>

    <?php  // echo $form->field($searchModel, 'harga_bayi') ?>

    <?php // echo $form->field($searchModel, 'timestamp') ?>

    <div class="form-group col-md-12">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::Button('Refresh', ['class' => 'btn btn-success','onclick'=>"location.reload()",]); ?>
        <?= Html::a(' Reset ', '/destinasi/index', ['class' => 'btn btn-warning']); ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end() ?>
</div>
