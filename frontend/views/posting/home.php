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
                        <div class='panel-heading' style='min-height:125px; max-height:125px;'><a href='/posting/view/".$konten->slug."'>".Html::img(['/posting/thumb','id'=>$konten->id],['class'=>'img-responsive', 'width'=>'100%','height'=>'100%'])."</a></div>
                     <ul class='list-group'>
                      <li class='list-group-item'><center>".Html::a($konten->idDestinasi->nama_destinasi,['/posting/view','slug'=>$konten->slug],['class'=>'btn ','style'=>'color:black'])."</center></li>";
                      
                      echo "<li class='list-group-item'><div class='glyphicon glyphicon-briefcase'> Start From ".$kurs->id." ". round($lowerCost[$key] / $kurs->round_kurs,2)." / pax</div> </li>";
                      
                  echo "
                      <li class='list-group-item'><div class='glyphicon glyphicon-user'> Min ". $konten->idDestinasi->min_pax ." Pax</div> </li>
                      <li class='list-group-item'><div class='glyphicon glyphicon-map-marker'> ". $konten->idDestinasi->idJenisDestinasi->jenis_destinasi ."</div> </li>
                

                     </ul>

                    <center style='padding-left: 0%;'>".Html::a('DETAIL',['/posting/view','slug'=>$konten->slug],['class'=>'btn btn-block btn-primary '])."</center>
                </div>
                </div>";
            }
        }else{
          echo "<div>Trip Tidak Ditemukan</div>";
        }
        

       ?>  

                      
        </div>
