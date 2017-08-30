<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;


/* @var $this yii\web\View */

$this->title = 'SELAMAT DATANG DI ISTANA TRAVEL';
?>
<?php
$this->registerJs("
$('#drop-dewasa, #drop-anak, #drop-bayi').on('change',function(){
    var ddewasa = $('#drop-dewasa').val();
    var ddanak = $('#drop-anak').val();
    var ddbayi = $('#drop-bayi').val();
  $.ajax({
        url: '".Url::to(["harga"])."',
        type: 'POST', 
        data: {paxd:ddewasa, paxa:ddanak, paxb:ddbayi, dest:".$model->idDestinasi->id."},
            success: function (div) {
            $('#harga').html( div );
            }, 
    });
});





");

?>

<div class="site-index">
 <div class="col-lg-12">

       
       
        <?php 
             echo "<div class='col-lg-8'>
                <h2>'".$model->judul_content."'</h2>

                <p>".$model->content.".</p></div>";

                
       ?>

    <div class="col-lg-4">
                  <div class="panel panel-primary">
      <div class="panel-heading">BOOKING FORM</div>
      <div class="panel-body">
          <?php $form = ActiveForm::begin(); ?>
<?php echo $form->field($modelBooking, 'tgl_trip')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Tanggal Keberangkatan'],
    'readonly' => true,
    'pickerButton' => false,
    //'size'=>'sm',
    'pluginOptions' => [
        'autoclose'=>true,
        'startDate' =>$mx ,
        'endDate' => date('Y-m-d', strtotime('+1 year', time())),
        'todayHighlight' => false,
        'format' => 'yyyy-mm-dd'
    ]
])->label('TANGGAL TRIP'); ?>


<?php  echo $form->field($modelBooking, 'dewasa')
        ->dropDownList(
            $listPD,
            ['id'=>'drop-dewasa']    

        );?>

<?php  echo $form->field($modelBooking, 'anak')
        ->dropDownList(
            $listPab,           // Flat array ('id'=>'label')
            [
            'id'=>'drop-anak'
            ]    // options
        );?>

<?php  echo $form->field($modelBooking, 'bayi')
        ->dropDownList(
            $listPab,           // Flat array ('id'=>'label')
            [
            'id'=>'drop-bayi'
            ]    // options
        );?>
        <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'BOOK NOW'), ['class' => 'btn-lg btn-block btn-warning']) ?>
    </div>

<?php ActiveForm::end(); ?>


      </div>
    </div>
            </div>                 
       
</div>

</div>

