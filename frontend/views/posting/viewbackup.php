<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;
use yii\bootstrap\Carousel;


/* @var $this yii\web\View */

$this->title = 'SELAMAT DATANG DI ISTANA TRAVEL';
?>
<?php
/*echo"<br> NAMA Leader";
var_dump($session['customer.nama_customer']);
echo"<br> Email LEader = ";
var_dump($session['customer.email']);*/
$this->registerJs("
$('#drop-dewasa, #drop-anak, #drop-bayi').on('change',function(){
    var ddewasa = $('#drop-dewasa').val();
    var ddanak  = $('#drop-anak').val();
    var ddbayi  = $('#drop-bayi').val();
    var vtgl    = $('#tgl-trip').val();
     $('#submitter').html('');
  $.ajax({
        url: '".Url::to(["cari-harga"])."',
        type: 'POST',
        data: {paxd:ddewasa, paxa:ddanak, paxb:ddbayi, tgl:vtgl, dest:".$model->idDestinasi->id."},
            success: function (div) {
            $('#submitter').html( div );
            },
    });
});






");



?>
 <?php
/*foreach ($rangeDate as $key ) {
   $tgl_mulai[] = $key->tgl_mulai;
   $tgl_selesai[] = $key->tgl_selesai;
}*/





/*
?>
<br>2. TANGGAL Mulai <?php

var_dump($rangeDate->tgl_mulai);
?><br>2. TANGGAL Selesai <?php

var_dump($rangeDate->tgl_selesai);
?>

<br> HASIL = <?php
$start = $rangeDate->tgl_mulai;
$end = $rangeDate->tgl_selesai;

while (strtotime($start) <= strtotime($end)) {
            echo $start."<BR>";
            $hasil[] = $start;
            $start = date ("Y-m-d", strtotime("+1 day", strtotime($start)));
};
var_dump($hasil);
 ?>
 <br><br><?php
 $tgl = "2017-09-25";
 $kos = null;
if (in_array($tgl, $hasil)){
        echo "TANGGAL ".$tgl." Ditemukan";
    }else{
        echo "TANGGAL ILANG";
    }

    var_dump($kos);*/
 ?>
 <style type="text/css">
     /*
inspired from https://codepen.io/Rowno/pen/Afykb 
*/
.carousel-fade .carousel-inner .item {
  opacity: 0;
  transition-property: opacity;
}

.carousel-fade .carousel-inner .active {
  opacity: 1;
}

.carousel-fade .carousel-inner .active.left,
.carousel-fade .carousel-inner .active.right {
  left: 0;
  opacity: 0;
  z-index: 1;
}

.carousel-fade .carousel-inner .next.left,
.carousel-fade .carousel-inner .prev.right {
  opacity: 1;
}

.carousel-fade .carousel-control {
  z-index: 2;
}

/*
WHAT IS NEW IN 3.3: "Added transforms to improve carousel performance in modern browsers."
now override the 3.3 new styles for modern browsers & apply opacity
*/
@media all and (transform-3d), (-webkit-transform-3d) {
    .carousel-fade .carousel-inner > .item.next,
    .carousel-fade .carousel-inner > .item.active.right {
      opacity: 0;
      -webkit-transform: translate3d(0, 0, 0);
              transform: translate3d(0, 0, 0);
    }
    .carousel-fade .carousel-inner > .item.prev,
    .carousel-fade .carousel-inner > .item.active.left {
      opacity: 0;
      -webkit-transform: translate3d(0, 0, 0);
              transform: translate3d(0, 0, 0);
    }
    .carousel-fade .carousel-inner > .item.next.left,
    .carousel-fade .carousel-inner > .item.prev.right,
    .carousel-fade .carousel-inner > .item.active {
      opacity: 1;
      -webkit-transform: translate3d(0, 0, 0);
              transform: translate3d(0, 0, 0);
    }
}



 </style>

<div style="min-height: 50%; max-height: 50%; max-width:100%;  min-width: 100%;" id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="/t-post/carrousel?id=3" alt="...">
      <div class="carousel-caption">
       
      </div>
    </div>
    <div class="item">
      <img src="/t-post/carrousel?id=6" alt="...">
      <div class="carousel-caption">
       
      </div>
    </div>
  
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="site-index">
 <div class="col-md-12">
<?php echo "<center><h2><strong>".$model->judul_content."</strong></h2></center>";
 foreach ($Carrousel as $modelx) {
        //echo Html::a('', ['/arsip/download','id'=>$modelx->id], ['class' => 'btn-lg btn-primary glyphicon glyphicon-download-alt']);
      $image[] = Html::img(['/t-post/carrousel','id'=>$modelx->id]/*,['width'=>'100%','height'=>'100%']*/);

        }


?>
        <?php
            
          //  }
              echo  "<div class='col-md-8'><div>".Carousel::widget(['items'=>array_values($image),'options' => ['class'=>'carousel-fade']],['options' => ['class'=>'carousel-fade']])."</div>

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
        echo $form->field($modelBooking, 'tgl_trip')->widget(DatePicker::classname(), [
        //'inline' => false,

        'readonly' => true,
        'pickerButton' => false,
        'language' => 'id',
        //'disabled' => $tgl,
        'pluginOptions' => [
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
       // "clearDate" => "function(e) {  # `e` here contains the extra attributes }",
        "changeDate" => "function() {
                        $('#div-pax').show();
                        var vtgl    = $('#tgl-trip').val();
                        var ddewasa = $('#drop-dewasa').val();
                        var ddanak  = $('#drop-anak').val();
                        var ddbayi  = $('#drop-bayi').val();
                        $.ajax({
                        url: '".Url::to(["cari-harga"])."',
                        type: 'POST',
                        data: {paxd:ddewasa, paxa:ddanak, paxb:ddbayi, tgl:vtgl, dest:".$model->idDestinasi->id."},
                        success: function (div) {
                        $('#submitter').html( div );
                        },
                        });
         }",

        ],
        ])->label('TANGGAL TRIP');




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
            <li class='list-group-item'><h4 class='text-justify'><strong>MOHON MAAF, SEAT PAX UNTUK TRIP INI SUDAH HABIS, JIKA ANDA TETAP INGIN MEMESSAN TRIP INI SILAHKAN HUBUNGI KAMI DI LIVE Chat Atau TINGGALKAN PESAN DI CONTACT US</strong></h4>
            </li>

         <ul>";
}elseif($model->idDestinasi->id_status == 2){
    echo "<ul class='list-group'>
            <li class='list-group-item'><h4 class='text-justify'><strong>MOHON MAAF, UNTUK SEMENTARA TRIP INI SEDANG TIDAK TERSEDIA</strong></h4>
            </li>
         <ul>";
}


?>


      </div>
    </div>
            </div>

</div>

<div class="col-md-8">
    <p><?php echo $model->content ?></p>
</div>

</div>

