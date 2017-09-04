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
    'name' => 'description',
    'content' => 'Welcome To Content description traviora.com',
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'travel bali',
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
            <?= Html::dropDownList('Currency', '',Yii::$app->view->params['listCurrency'], ['id'=>'drop-cur','class'=>'form-control']); ?>
          </div>
          <div class="col-md-3">
            <?= Html::label('Location', 'Location',['class'=>'control-label'] ); ?>
            <?= Html::dropDownList('Lokasi', '', Yii::$app->view->params['listLokasi'], ['prompt'=>'--> All Location <--','class'=>'form-control','id'=>'drop-lokasi']); ?>
          </div>
          <div class="col-md-3">
          <?= Html::label('Trip Type', 'Jenis Trip',['class'=>'control-label'] ); ?>
          <?= Html::dropDownList('Jenis Trip', '', Yii::$app->view->params['jenidDestinasi'], ['prompt'=>'--> All Trip Type <--','class'=>'form-control','id'=>'drop-jenis-trip']); ?>
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

<div style="padding-top: 0px;">
   <?=
  $this->render('trip-card',[
      'dataProvider' => $dataProvider,
      'lowerCost'=>$lowerCost,
      'kurs'=>$kurs,
      'pages' => $pages,
    ])

     ?>
    
</div>

 

                      