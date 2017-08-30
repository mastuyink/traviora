<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\TPostSearch */
/* @var $form yii\widgets\ActiveForm */ 
?>

<div class="tpost-search">
<div class="col-md-3">
   <?php 
     echo '<label class="control-label">Kode Booking</label>';
    echo Select2::widget([
    'model' => $model,
    'attribute' => 'id',
    'data' => $pencarian,
    'options' => ['placeholder' => 'Cari Kode Booking','id'=>'drop-kode'],
    'pluginOptions' => [
        'allowClear' => true,
      //  'tags' => true,
    ],
]);?>
</div>
<div class="col-md-3">    
    <?php  
    echo '<label class="control-label">Pengirim</label>';
    echo Select2::widget([
    'model' => $model,
    'attribute' => 'nama_pengirim',
    'data' => $pengirim,
    'options' => ['placeholder' => 'Cari Pengirim','id'=>'form-sender'],
    'pluginOptions' => [
        'allowClear' => true,
      //  'tags' => true,
    ],
]);?>
</div>
<div class="col-md-3">
    <?php
        echo '<label class="control-label">Date Of trip</label>';
        echo DatePicker::widget([
        'model' => $model, 
        'attribute' => 'tgl_trip',
        'readonly' => true,
        'options' => ['placeholder' => 'Select Date','id'=>'form-tgl-trip'],
        'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd',
        ]
        ]); 
    ?>
</div>
<div class="col-md-3">
    <?php
        echo '<label class="control-label">Booking Time</label>';
        echo DatePicker::widget([
        'model' => $model, 
        'attribute' => 'waktu_booking',
        'readonly' => true,
        'options' => ['placeholder' => 'Select Date','id'=>'form-waktu-booking'],
        'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd',
        ]
        ]); 
    ?>
</div>
<div class="col-md-3">
    <?php
        echo '<label class="control-label">Confirm Time</label>';
        echo DatePicker::widget([
        'model' => $model, 
        'attribute' => 'waktu_konfirmasi',
        'readonly' => true,
        'options' => ['placeholder' => 'Select Date','id'=>'form-waktu-konfirmasi'],
        'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd',
        ]
        ]); 
    ?>
</div>
  

    <?php // echo $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'last_update') ?>

    <div class="form-group">
               
   
   <div class="col-md-12">
       <?= Html::button('Cari', [
       'class' => 'btn btn-warning',
       'onclick'=>'
            var base = "&CariData";
            var id   = "[id]="+$("#drop-kode").val();;
            var wbok = base+"[waktu_booking]="+$("#form-waktu-booking").val();
            var wkon = base+"[waktu_konfirmasi]="+$("#form-waktu-konfirmasi").val();
            var send = base+"[nama_pengirim]="+$("#form-sender").val();
            $.pjax.reload({
                url : "'.Url::to(["index"]).'?CariData"+id+send+wbok+wkon,
                container: "#pjax-validasi",
                nevertimeout: true,
             });
        ']); ?>

       <?= Html::button('Reset', [
       'class' => 'btn btn-primary',
       'onclick'=>'
            $.pjax.reload({
                url : "'.Url::to(["index"]).'",
                container: "#pjax-validasi",
                nevertimeout: true,
             });
        ']); ?>
   </div>
    </div>


</div>
