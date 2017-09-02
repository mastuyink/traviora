<?php

use yii\helpers\Html;
use yii\bootstrap\Carousel;
use yii\widgets\Pjax;
use yii\helpers\Url;
use kartik\widgets\AlertBlock;

/* @var $this yii\web\View */

$this->title = 'Welcome To Traviora';

?>
<?php 
$this->registerJs("
$('#pencarian').on('click',function(){
  $('#form-cari').toggle(500);
});

$(document).ready(function(){
  $('#drop-cur').val('USD');
});
");

$this->registerMetaTag([
    'name' => 'This Is Name Meta tag Tarviora',
    'content' => 'Ini Adalah Content dari meta tag',
]);
?>
<style type="text/css">
  .control-label{
    color: black;
    align-content: left;
    align-items: left;
  }
  .img-thum{
  display: block;
  width: 100%;
  height: auto;
  }
  .panel-heading{
    padding: 0px 0px 0px 0px;
  }
</style>

<div style="padding-bottom: 2%;" id="search-form" class="col-md-12 col-md-offset-1">

          <div class="col-md-1">
            <?= Html::label('Currency', '',['class'=>'control-label'] ); ?>
            <?= Html::dropDownList('Currency', '',$listCurrency, ['id'=>'drop-cur','class'=>'form-control']); ?>
          </div>
          <div class="col-md-3">
            <?= Html::label('Location', 'Location',['class'=>'control-label'] ); ?>
            <?= Html::dropDownList('Lokasi', '', $listLokasi, ['prompt'=>'--> All Location <--','class'=>'form-control','id'=>'drop-lokasi']); ?>
          </div>
          <div class="col-md-3">
          <?= Html::label('Trip Type', 'Jenis Trip',['class'=>'control-label'] ); ?>
          <?= Html::dropDownList('Jenis Trip', '', $jenidDestinasi, ['prompt'=>'--> All Trip Type <--','class'=>'form-control','id'=>'drop-jenis-trip']); ?>
          </div>
          <div class="col-md-2">
          <?= Html::label('Sort By', 'sort',['class'=>'control-label'] ); ?>
          <?= Html::dropDownList('sort', '',['1'=>'Trip terbaru','2'=>'Trip Lama'], ['class' => 'form-control','id'=>'drop-sort']); ?>
          </div>
          <div style="padding-top: 1%;" class="col-md-12 col-md-offset-3">
        <?= Html::button(' Apply ', [
                        'class'=>'btn btn-danger',
                        'onclick'=>'
                        var asc = $("#drop-sort").val();
                        var lok = $("#drop-lokasi").val();
                        var jds = $("#drop-jenis-trip").val();
                        var curv = $("#drop-cur").val();
                        $("#loading").html("<center><img src=loading.svg></center>");
                         $.pjax.reload({
                         url : "'.Url::to(['/']).'",
                         type: "POST",
                         data: {val: asc, vlok: lok, vjds: jds, curx: curv},
                         container: "#pjax-index",
                         
                       });']);
      ?>

      <?= Html::button(' Reset Filter ', [
                        'class'=>'btn btn-warning',
                        'onclick'=>'
                        $("#drop-sort").val(1);
                        $("#drop-lokasi").val("");
                        $("#drop-jenis-trip").val("");
                        $("#drop-cur").val("USD");
                        ']);
      ?>
      </div>

  </div>

<div  style="padding-top: 0px;">

<?php Pjax::begin(['id'=>'pjax-index']); ?>              
<div class="col-md-12" id="loading">

        <?php 

        if ($dataProvider !== null) {
              foreach ($dataProvider as $key => $konten) {
                 echo "<div class='col-md-4' >
                 <div class='panel panel-default' style='min-height:200%;'>
                        <div class='panel-heading' style='min-height:100%;'><a href='".strtolower($konten->idDestinasi->idLokasiDestinasi->lokasi)."/".strtolower($konten->idDestinasi->idJenisDestinasi->jenis_destinasi)."/".strtolower($konten->slug)."'>".Html::img(['/posting/thumb','id'=>$konten->id],['alt'=>'thumb','class'=>'img-thum', 'width'=>'100%','height'=>'auto'])."</a></div>
                     <ul class='list-group'>
                      <li class='list-group-item'><center>".Html::a($konten->idDestinasi->nama_destinasi,['/posting/view','lokasi'=>strtolower($konten->idDestinasi->idLokasiDestinasi->lokasi),'kategori'=>strtolower($konten->idDestinasi->idJenisDestinasi->jenis_destinasi),'slug'=>strtolower($konten->slug)],['style'=>'color:black; text-decoration: none;'])."</center></li>";
                      
                      echo "<li class='list-group-item'><div class='glyphicon glyphicon-briefcase'> Start From ".$kurs->id." ". round($lowerCost[$key] / $kurs->round_kurs,2)." / pax</div> </li>";
                      
                  echo "
                      <li class='list-group-item'><div class='glyphicon glyphicon-user'> Min ". $konten->idDestinasi->min_pax ." Pax</div> </li>
                      <li class='list-group-item'><div class='glyphicon glyphicon-map-marker'> ". $konten->idDestinasi->idJenisDestinasi->jenis_destinasi ."</div> </li>
                

                     </ul>

                    <center style='padding-left: 0%;'>".Html::a('DETAIL',['/posting/view','lokasi'=>strtolower($konten->idDestinasi->idLokasiDestinasi->lokasi),'kategori'=>strtolower($konten->idDestinasi->idJenisDestinasi->jenis_destinasi),'slug'=>$konten->slug],['class'=>'btn btn-block btn-primary '])."</center>
                </div>
                </div>";
            }
        }else{
          echo "<div>Trip Tidak Ditemukan</div>";
        }
        

       ?> 
       </div>
    <?php Pjax::end(); ?>
                      
        </div>
<?php 

echo AlertBlock::widget([
            'useSessionFlash' => true,
            'type' => AlertBlock::TYPE_GROWL
            ]);
      ?>