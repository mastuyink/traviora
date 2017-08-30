<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\TLiburTrip */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $js = '

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

<div class="tlibur-trip-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>



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
        'model' => $model[0],
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
            <?php foreach ($model as $index => $LiburTrip): ?>
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
							<?= $form->field($LiburTrip, '[{$index}]id_destinasi')->widget(Select2::classname(), [
							'data' => $des,
							// 'language' => 'de',
							'options' => ['placeholder' => 'Masukkan Destinasi'],
							'pluginOptions' => [
							'allowClear' => true,
							
							],
							]);
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
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
