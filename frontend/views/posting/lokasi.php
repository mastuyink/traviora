<?php

use yii\helpers\Html;
use yii\bootstrap\Carousel;

/* @var $this yii\web\View */

$this->title = 'SELAMAT DATANG DI ISTANA TRAVEL';
$this->registerJs("
  $('.carousel').carousel()
  ");
?>


<div style="padding-top: 0px;">

              
      <?php 

       
        if ($dataProvider !== null) {
              foreach ($dataProvider as $key => $konten) {
                 echo "<div class='col-md-4' >
                 <div class='panel panel-default' style='min-height:200%;'>
                        <div class='panel-heading' style='min-height:100%;'><a href='".strtolower($konten->idDestinasi->idLokasiDestinasi->lokasi)."/".strtolower($konten->idDestinasi->idJenisDestinasi->jenis_destinasi)."/".strtolower($konten->slug)."'>".Html::img(['/posting/thumb','id'=>$konten->id],['alt'=>'thumb','class'=>'img-thum', 'width'=>'100%','height'=>'auto'])."</a></div>
                     <ul class='list-group'>
                      <li class='list-group-item'><center>".Html::a($konten->idDestinasi->nama_destinasi,['/posting/view','lokasi'=>strtolower($konten->idDestinasi->idLokasiDestinasi->lokasi),'kategori'=>strtolower($konten->idDestinasi->idJenisDestinasi->jenis_destinasi),'slug'=>strtolower($konten->slug)],['style'=>'color:black; text-decoration: none;'])."</center></li>";
                      
                      /*echo "<li class='list-group-item'><div class='glyphicon glyphicon-briefcase'> Start From ".$kurs->id." ". round($lowerCost[$key] / $kurs->round_kurs,2)." / pax</div> </li>";
                      */
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
