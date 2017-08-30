<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelPembayaran app\models\TPembayaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tpembayaran-form">

    <?php $form = ActiveForm::begin(); ?>

    

    <?= $form->field($modelpembayaran, 'id_metode')
        ->dropDownList(
            $metode_bayar,           // Flat array ('id'=>'label')
            ['prompt'=>' Pilih Medote Pembayaran']    // options
        );?>

   

    <div class="form-group">
        <?= Html::submitButton( Yii::t('app', 'Create') , ['class' => 'btn-lg btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>