<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use kartik\switchinput\SwitchInput;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\date\DatePicker;
use kartik\label\LabelInPlace;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\TDestinasi */
/* @var $form yii\widgets\ActiveForm */

$model->isNewRecord ? $model->id_jenis_konfirmasi = 1  : $model->id_jenis_konfirmasi = $model->id_jenis_konfirmasi;
$hariTrip->isNewRecord ? $hariTrip->id_jenis_hari_trip = 1 : $hariTrip->id_jenis_hari_trip = $hariTrip->id_jenis_hari_trip;

$js = '

jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {

    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {

        jQuery(this).html("Libur Ke : " + (index + 1))

    });

});


jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {

    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {

        jQuery(this).html("Libur Ke : " + (index + 1))

    });

});

';


$this->registerJs($js);
?>
<?php
$this->registerJs("
$(document).ready(function(){
    var radx = $('input:radio:checked').val();
    if (radx == 2 ) {
        $('#div-hari').show();
    }else{
   $('#div-hari').hide();
   }
});

$('.dynamicform_wrapper').on('afterInsert', function(e, item) {
    var datePickers = $(this).find('[data-krajee-kvdatepicker]');
    datePickers.each(function(index, el) {
        $(this).parent().removeData().kvDatepicker('remove');
        $(this).parent().kvDatepicker(eval($(this).attr('data-krajee-kvdatepicker')));
    });
});

");

 ?>
 <?php 
//$model->isNewRecord ? $model->id_status = 1 && $hariTrip->id_jenis_hari_trip = 1: $model->id_status = $model->id_status && $hariTrip->id_jenis_hari_trip = $hariTrip->id_jenis_hari_trip;

 $config = ['template'=>"{input}\n{error}\n{hint}"];


 ?>
<div class="tdestinasi-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
     <?= $form->field($model, 'id_supplier')->widget(Select2::classname(), [
                'data' => $supplier,
                // 'language' => 'de',
                'options' => ['placeholder' => 'Pilih Supplier'],
                'pluginOptions' => [
                'allowClear' => true,
                 //'tags' => true,
                ],
                ]);
       ?>
    <?= $form->field($model, 'id_lokasi_destinasi')->dropDownList(
            $lokasi,           // Flat array ('id'=>'label')
            ['prompt'=>' Pilih Lokasi Destinasi']    // options
        );?>

    <?= $form->field($model, 'id_jenis_destinasi')->dropDownList(
            $jenisd,           // Flat array ('id'=>'label')
            ['prompt'=>' Pilih Jenis Destinasi']    // options
        );?>

    <?= $form->field($model, 'nama_destinasi',$config)->widget(LabelInPlace::classname(),[
               'defaultIndicators'=>false,
               'encodeLabel'=> false]
               ); ?>

    <?= $form->field($model, 'jatah_seat',$config)->widget(LabelInPlace::classname(),[
               'defaultIndicators'=>false,
               'encodeLabel'=> false]
               ); ?>
    <?= $form->field($model, 'stok_seat',$config)->widget(LabelInPlace::classname(),[
               'defaultIndicators'=>false,
               'encodeLabel'=> false]
               ); ?>

    <?= $form->field($model, 'min_pax',$config)->widget(LabelInPlace::classname(),[
               'defaultIndicators'=>false,
               'encodeLabel'=> false]
               ); ?>

    <?= $form->field($model, 'max_pax',$config)->widget(LabelInPlace::classname(),[
               'defaultIndicators'=>false,
               'encodeLabel'=> false]
               ); ?>

    <?= $form->field($model, 'main_limit',$config)->widget(LabelInPlace::classname(),[
               'defaultIndicators'=>false,
               'encodeLabel'=> false]
               ); ?>
    <?= $form->field($model, 'id_jenis_konfirmasi')->radioList(['1'=>'Auto','2'=>'Manual'],[
    'inline'=>true,    ]); ?>
   
    <?php
    if ($model->isNewRecord) {

        echo "<strong style='color: green;'>Trip Akan otomatis ON Jika Skema tarif Telah Di Set</strong>";
     }elseif ($model->id_status === 3 ) {
        echo "<strong style='color: red;'>Silahkan Set Skema Tarif Untuk trip ini, Agar trip  Dapat ON</strong>";
     }else{
    echo $form->field($model, 'id_status')->widget(SwitchInput::classname(), [
    'options'=>['uncheck' => 2,'value'=>1,],
    'type' => SwitchInput::CHECKBOX
    ]);
    }
    ?>

    <?= $form->field($hariTrip, 'id_jenis_hari_trip')->radioList(['1'=>'Setiap hari','2'=>'Hari tertentu'],[
    'id'=>'rad-jenis-hari',
    'inline'=>true,
    'onchange'=>'
    var rad = $("#rad-jenis-hari input:radio:checked").val();
    if (rad == "1") {
       $(".hari").prop("checked", true);
       $("#div-hari").hide(500);
    }else{
        $(".hari").prop("checked", false);
        $("#div-hari").show(500);

    }'
    ]); ?>

    <div id="div-hari">
              <h4>Hari Ketersediaan Trip</h4>
            <div class="col-md-2">
            <?= $form->field($hariTrip, 'id_senin')->checkbox(['uncheck' => 1,'value'=>100,'class'=>'hari']); ?>   
            <?= $form->field($hariTrip, 'id_selasa')->checkbox(['uncheck' => 2,'value'=>100,'class'=>'hari']); ?>
            <?= $form->field($hariTrip, 'id_rabu')->checkbox(['uncheck' => 3,'value'=>100,'class'=>'hari']); ?>
            </div>      
            
           <div class="col-md-2">
           <?= $form->field($hariTrip, 'id_kamis')->checkbox(['uncheck' => 4,'value'=>100,'class'=>'hari']); ?>   
            <?= $form->field($hariTrip, 'id_jumat')->checkbox(['uncheck' => 5,'value'=>100,'class'=>'hari']); ?>   
            <?= $form->field($hariTrip, 'id_sabtu')->checkbox(['uncheck' => 6,'value'=>100,'class'=>'hari']); ?>
            </div>   

            <?= $form->field($hariTrip, 'id_minggu')->checkbox(['uncheck' => 0,'value'=>100,'class'=>'hari']); ?>
    </div>


<div style="padding-top: 75px;" class="padding-v-md">

        <div class="line line-dashed"></div>

    </div>
    <?php DynamicFormWidget::begin([

        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
       // 'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $liburTtrip[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'tgl_libur',
            'address_line1',
           
        ],

    ]); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-envelope"></i> Tanggal Libur Trip
            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="btn glyphicon glyphicon-plus"></i></button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items"><!-- widgetContainer -->
            <?php foreach ($liburTtrip as $index => $LiburTrip): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <span class="panel-title-address">Libur Ke: <?= ($index + 1) ?></span>
                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (!$LiburTrip->isNewRecord) {
                                echo Html::activeHiddenInput($LiburTrip, "[{$index}]id");
                            }
                        ?>
                            <?php 
                            // $modelBooking->tgl_trip = $session['booking.tgl_trip'];
                            echo $form->field($LiburTrip, "[{$index}]tgl_libur")->widget(DatePicker::classname(), [
                            'options'        => [
                            'placeholder'    => 'Tanggal Libur'],
                            //'readonly'     => true,
                            'pickerButton'   => [
                                                'icon'=>'ok',
                            ],
                            //'size'         =>'sm',
                            'pluginOptions'  => [
                            'autoclose'      =>true,
                            'startDate'   =>date('Y-m-d') ,
                           // 'endDate'        => date('Y-m-d', strtotime('+1 year', time())),
                            'todayHighlight' => false,
                            'format'         => 'yyyy-mm-dd',
                            'id'             =>'tgl-libur',
                            
                            ]])->label('Tanggal'); ?>

                  

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

    <?php DynamicFormWidget::end(); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Tambah ') : Yii::t('app', 'Simpan'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

    
</div>
