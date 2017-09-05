<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
?>
<style type="text/css">
  .img-thum{
  box-sizing: border-box;
  max-width: 100%;
  max-height: 100%;
  height: 125px;

  }
  .panel-heading{
    padding: 0px 0px 0px 0px;
  }
</style>

              
<div class="col-md-12" id="loading">

  <?php 
        if ($dataProvider != null) {
              foreach ($dataProvider as $key => $konten) {
                 echo "<div class='col-md-4' >
                 <div class='panel panel-default' style='min-height:200%;'>
                        <div class='panel-heading'><a href='".strtolower($konten->idDestinasi->idLokasiDestinasi->lokasi)."/".strtolower($konten->idDestinasi->idJenisDestinasi->jenis_destinasi)."/".strtolower($konten->slug)."'>".Html::img(['/posting/thumb','id'=>$konten->id],['alt'=>'thumb','class'=>'img-thum', ])."</a></div>
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
         echo "<center><h3>TRIP NOT AVAIBLE</h3></center>"; 
        }
        

       ?> 
       </div>
       <div class=" col-md-12 btn btn-xs btn-info">
  <?php 
  echo LinkPager::widget([
    'pagination' => $pages,
]);
  ?>
  </div>
  
