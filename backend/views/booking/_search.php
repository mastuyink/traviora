<?php

use yii\helpers\Html;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\searchModels\TBookingSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$this->registerJs("
    $(document).on('pjax:send', function() {
               // alert('proses');
             });
    $(document).on('pjax:complete', function() {
                //alert('beres');
             });
    $(document).on('pjax:timeout', function(event) {
        alert('Request Timeout- Please Reload The Page');
    })
");
 ?>
<div class="tbooking-search">


    <div class="col-md-3">
        <?php 
        echo '<label class="control-label">Kode Booking</label>';
        echo Select2::widget([
                'model' => $searchModel,
                'attribute' => 'id',
                'data' => $noOrder,
                // 'language' => 'de',
                'options' => ['placeholder' => 'Cari Kode Booking','id'=>'form-id'],
                'pluginOptions' => [
                'allowClear' => true,
                // 'tags' => true,
                // 'multiple'=>true
                ],
                ]);
       ?></div>

    <div class="col-md-3">
     <?php 
        echo '<label class="control-label">Name Of Trip</label>';
        echo Select2::widget([
                'model' => $searchModel,
                'attribute' => 'id_destinasi',
                'data' => $des,
                // 'language' => 'de',
                'options' => ['placeholder' => 'Masukkan Destinasi','id'=>'form-destinasi'],
                'pluginOptions' => [
                'allowClear' => true,
                 'tags' => true,
                ],
                ]);
       ?></div>

    <div class="col-md-3">
     <?php 
        echo '<label class="control-label">Leader</label>';
        echo Select2::widget([
                'data' => $customer,
                'model' => $searchModel,
                'attribute'=>'id_customer',
                // 'language' => 'de',
                'options' => ['placeholder' => 'nama Leader','id'=>'form-customer'],
                'pluginOptions' => [
                'allowClear' => true,
                 'tags' => true,
                ],
                'id'=>'book-id',
                ]);
       ?></div>


    <div class="col-md-3">
    <?php
     echo '<label class="control-label">Trip Date</label>';  
     echo DatePicker::widget([
        'model' => $searchModel,
                'attribute'=>'tgl_trip',
         'options'        => [
         //'value'=>date('Y-m-d'),
         'placeholder'    => 'Tanggal Keberangkatan','id'=>'form-tgl-trip'],

       //  'readonly'       => true,
         'pickerButton'   => false,
         //'size'         =>'sm',
         'pluginOptions'  => [

         'autoclose'      =>true,
         //'startDate'      =>$mx ,
        // 'endDate'        => date('Y-m-d', strtotime('+1 year', time())),
         'todayHighlight' => true,
         'format'         => 'yyyy-mm-dd',
        
         
         ]
         ]); ?></div>

    <div class="col-md-3">
     <?php echo '<label class="control-label">Book Date</label>';  
     echo DatePicker::widget([
        'model' => $searchModel,
                'attribute'=>'waktu_booking',
         'options'        => ['placeholder'    => 'Tanggal Booking','id'=>'form-waktu-booking'],
       //  'readonly'       => true,
         'pickerButton'   => false,
         //'size'         =>'sm',
         'pluginOptions'  => [
         'autoclose'      =>true,
         //'startDate'      =>$mx ,
        // 'endDate'        => date('Y-m-d', strtotime('+1 year', time())),
         'todayHighlight' => true,
         'format'         => 'yyyy-mm-dd',
       
         
         ]
         ]) ?></div>

    <div class="col-md-3">
    <?php 
         echo '<label class="control-label">Status</label>';  
         echo Html::activeDropDownList($searchModel, 'id_status', $sts, ['prompt'=>'- - > Select Status < - -','class' => 'form-control','id'=>'form-status']); ?></div>

    <?php $id = ""; // echo $form->field($searchModel, 'timestamp') ?>

   <div class="form-group">
               
   
   <div class="col-md-12">
       <?= Html::button('', [
       'class' => 'btn btn-info  glyphicon glyphicon-search',
       'onclick'=>'
            var base  = "&TBookingSearch";
            var id    = "[id]="+$("#form-id").val();;
            var des   = base+"[id_destinasi]="+$("#form-destinasi").val();
            var cust  = base+"[id_customer]="+$("#form-customer").val();
            var tgl   = base+"[tgl_trip]="+$("#form-tgl-trip").val();
            var btime = base+"[waktu_booking]="+$("#form-waktu-booking").val();
            var sts   = base+"[id_status]="+$("#form-status").val();
            $.pjax.reload({
                url : "'.Url::to(["index"]).'?TBookingSearch"+id+des+cust+tgl+btime+sts,
                container: "#pjax-booking",
                timeout : 10000,
                success: function(){
                    
                },
             });


        ']); ?>

       <?= Html::button('', [
       'class' => 'btn btn-primary glyphicon glyphicon-refresh',
       'onclick'=>'
            $.pjax.reload({
                url : "'.Url::to(["index"]).'",
                container: "#pjax-booking",
                timeout : 10000,
             });
        ']); ?>
        <?= Html::a('Refresh Data', '/booking/index', ['class' => 'btn btn-danger']); ?>
   </div>
    </div>



</div>
