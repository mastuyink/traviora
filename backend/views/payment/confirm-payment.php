<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $modelPembayaran app\modelPembayarans\TDestinasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-form">
<h3>
<div clas="col-lg-12">KONFIRMASI PEMBAYARAN UNTUK PESANAN NOMOR = <?= $modelPembayaran->id_booking ?>
</div>
</h3>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($modelPembayaran, 'nama_pengirim')->textInput(['maxlength' => true,'placeholder'=>'nama_pengirim']) ?>
    <?php echo $form->field($modelPembayaran, 'tgl_kirim')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Tanggal Kirim'],
    'readonly' => true,
    'pickerButton' => false,
    //'size'=>'sm',
    'pluginOptions' => [
    	'defaultValue'=>date('Y-m-d'),
        'autoclose'=>true,
        'startDate' =>date('Y-m-d',strtotime('-7 days')),
        'endDate' => date('Y-m-d'),
        'todayHighlight' => true,
        'format' => 'yyyy-mm-dd'
    ]
]); ?>

    <?= $form->field($modelPembayaran, 'jumlah_kirim')->textInput(['placeholder'=>'Jumlah Kirim ']) ?>

    <div class="form-group">
        <?= Html::submitButton( Yii::t('app', 'KONFIRMASI'), ['class' =>'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

