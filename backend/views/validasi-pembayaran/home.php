<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'SELAMAT DATANG DI ISTANA TRAVEL';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>SELAMAT DATNG!</h1>

        <p class="lead"></p>

    </div>

    <div class="body-content">

        <div class="row">
       
        <?php 
 
        foreach ($dataProvider as $konten) {
             echo "<div class='col-lg-4'>
                <h2>'".$konten->judul_content."'</h2>

              

                <p>".Html::a('DETAIL',['view','id'=>$konten->id],['class'=>'btn-lg btn-info glyphicon glyphicon-arrow-right'])."</p>
            </div>";
        }

       ?> 

                      
        </div>

    </div>
</div>
