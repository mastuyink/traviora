<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\form\ActiveField;
use kartik\date\DatePicker;
use yii\bootstrap\Carousel;


/* @var $this yii\web\View */
$lokasi = strtolower($model->idDestinasi->idLokasiDestinasi->lokasi);
$this->title = $model->idDestinasi->nama_destinasi;
$this->params['breadcrumbs'][] = ['label' =>$lokasi,'url' => ['/site/view-lokasi', 'lokasi' => $lokasi]];
$this->params['breadcrumbs'][] = strtolower($model->idDestinasi->idJenisDestinasi->jenis_destinasi);
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$this->registerJs("

$('#drop-dewasa, #drop-anak, #drop-bayi').on('change',function(){
    
    var ddewasa = $('#drop-dewasa').val();
    var ddanak  = $('#drop-anak').val();
    var ddbayi  = $('#drop-bayi').val();
    var vtgl    = $('#tgl-trip').val();
    if (vtgl != '') {
      $('#submitter').html('<center><img src=../../line.svg width=75 height=75></center>');
      $.ajax({
            url: '".Url::to(["cari-harga"])."',
            type: 'POST',
            data: {paxd:ddewasa, paxa:ddanak, paxb:ddbayi, tgl:vtgl, dest:".$model->id_destinasi."},
                success: function (div) {
                $('#submitter').html( div );
                },
        });
    }else{
      $('#submitter').html('<center><h4 class= btn-danger>Please Choose Date</h4></center>');
    }
   
});






");



?>
<style type="text/css">
/* CUSTOMIZE THE CAROUSEL
-------------------------------------------------- */

.carousel {
  margin-bottom: 0%;
}

.carousel-control {
  top: 40%;
}

.carousel-caption {
  z-index: 10;
}

.carousel .item {
  height: 370px;
  background-color:#bbb;
  overflow:hidden;
}
.carousel img {
  position: absolute;
  top: 0;
  left: 0;
  min-width: 100%;
  height: 370px;
}


/* RESPONSIVE CSS
-------------------------------------------------- */
@media (max-width: 768px) {

  .carousel-inner>.item>img, .carousel-inner>.item>a>img {
    max-width:inherit;
  }

  .carousel-caption p {
    margin-bottom: 20px;
    font-size: 21px;
    line-height: 1.4;
  }
}
</style>

<?php 

echo "<center><h2><strong>".$model->idDestinasi->nama_destinasi."</strong></h2></center>";


 foreach ($Carrousel as $modelx) {
      $image[] = Html::img(['/posting/carrousel','id'=>$modelx->id]/*,['style'=>'max-height:125%']*/);

        }
?>
<div class="col-md-12">
        <?php
              echo  "<div class='col-md-8'><div>".Carousel::widget(['items'=>array_values($image)])."</div>
              </div>";
       ?>

    <div class="col-md-4">
      <div class="panel panel-primary">
      <div class="panel-heading">BOOKING FORM</div>
      <div class="panel-body">
    <?php if ($model->idDestinasi->id_status == 1 && $Dest->stok_seat >= $Dest->min_pax) {
        $form = ActiveForm::begin(); ?>

        <?php
       //var_dump($Booking);
        echo $form->field($modelBooking, 'tgl_trip', [
    'hintType' => ActiveField::HINT_SPECIAL,
    'hintSettings' => [
          'placement' => 'right',
          'onLabelClick' => true,
          'title' => '<i class="glyphicon glyphicon-info-sign"></i> Note'
      ]
])->widget(DatePicker::classname(), [
        //'inline' => false,

        'readonly' => true,
        'pickerButton' => false,
        'language' => 'id',
        //'disabled' => $tgl,
        'pluginOptions' => [
        'orientation' => 'bottom left',
        'autoclose'=>true,
       // 'convertFormat'=>true,
        'startDate' =>$mx ,
        // 'endDate' => date('Y-m-d', strtotime('+1 year', time())),
        'todayHighlight' => true,
        'format' => 'yyyy-mm-dd',
        'daysOfWeekDisabled'=>[$senin,$selasa,$rabu,$kamis,$jumat,$sabtu,$minggu],
        'datesDisabled'=>$DisDate,
        // 'enableDates'=>["2017-07-25"]
        ],
        'options' => ['placeholder' => 'Tanggal Keberangkatan','id'=>'tgl-trip'],
        'pluginEvents' => [
         "show" => "function() { 
              $('.kv-type-label').trigger('mouseenter');
           }",
       // "clearDate" => "function(e) {  # `e` here contains the extra attributes }",
        "changeDate" => "function() {
                        $('.kv-type-label').trigger('mouseout');
                        $('.popover').show();
                        $('#div-pax').show();
                        var vtgl    = $('#tgl-trip').val();
                        var ddewasa = $('#drop-dewasa').val();
                        var ddanak  = $('#drop-anak').val();
                        var ddbayi  = $('#drop-bayi').val();
                        if (vtgl != '') {
                            $('#submitter').html('<center><img src=../../line.svg width=75 height=75></center>');
                            $.ajax({
                            url: '".Url::to(["cari-harga"])."',
                            type: 'POST',
                            data: {paxd:ddewasa, paxa:ddanak, paxb:ddbayi, tgl:vtgl, dest:".$model->idDestinasi->id."},
                            success: function (div) {
                            $('#submitter').html( div );
                            },
                            });
                        }else{
                        $('#submitter').html('<center><h4 class= btn-danger>Please Choose Date</h4></center>');
                        }
         }",

        ],
        ])->hint('if day Or date trip cannot Be Select, This Trip Not Avaible On current Date. For information, you can contact Us');;




        echo "<div id='div-pax'>".$form->field($modelBooking, 'dewasa')->dropDownList($listPD,['id'=>'drop-dewasa']);

        echo $form->field($modelBooking, 'anak')->dropDownList($listPab,['id'=>'drop-anak' ]);
        echo $form->field($modelBooking, 'bayi')->dropDownList($listPab,['id'=>'drop-bayi']);
        echo Html::error($modelBooking, 'pax_request', ['class' => 'text-capitalize text-danger']);
        echo "<div id='submitter' class='form-group'>";
        /*
        echo Html::submitButton(Yii::t('app', 'BOOK NOW'), ['class' => 'btn-lg btn-block btn-warning']);
        //echo "</div>";
        echo "<ul class='list-group'>
                <li class='list-group-item'>
                    <h4><strong><p id='harga'>Rp </p></strong></h4>
                    </li>
             </ul>

             ";*/
        echo "</div></div>";


           //  var_dump($session['booking.biaya_trip']);
        ActiveForm::end();
}elseif($model->idDestinasi->id_status == 1 && $Dest->stok_seat < $Dest->min_pax){
    echo "<ul class='list-group'>
            <li class='list-group-item'><h4 class='text-justify'><strong>SORRY, SEAT FOR THIS TRIP ALREADY OUT, IF YOU STAY WOULD LIKE TO TRY THIS TRIP PLEASE CONTACT US</strong></h4>
            </li>

         <ul>";
}elseif($model->idDestinasi->id_status == 2){
    echo "<ul class='list-group'>
            <li class='list-group-item'><h4 class='text-justify'><strong>SORRY, FOR WHILE THIS TRIP IS NOT AVAILABLE</strong></h4>
            </li>
         <ul>";
}


?>


      </div>
    </div>
            </div>

</div>
<div class="col-md-12">
<div class="col-md-8">
    <p><?php echo $model->content ?></p>
</div>
<div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading"></div>
      <div class="panel-body">
          <ul class='list-group'>
            <li class='list-group-item'>Need Help Or More Information ? Contact Us
            <?php
              $url = Yii::$app->request->getUrl();
           
              echo Html::a('Here', ['/site/contact'], ['class' => 'text-danger']);  ?>
            </li>
         <ul>
      </div>
      </div>
</div>
</div>



