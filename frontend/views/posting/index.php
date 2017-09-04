<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\Helper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TPostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'POSTING TRIP');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tpost-index">

    <center><h1><strong><?= Html::encode($this->title) ?></strong></h1></center>
   

    
     <p>
        <?= Html::a(Yii::t('app', ''), 'create', ['class' => 'btn btn-lg btn-danger glyphicon glyphicon-plus']) ?>
    </p>
   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'idDestinasi.nama_destinasi',
            'description',
            'keywords',
            'slug',
           // 'create_at',
            ['header'=>'Lats Update',
            'value'=>'last_update'],
         
            ['header'=>'Author',
            'value'=>'idAuthor.username'],
            
           [
           'class' => 'yii\grid\ActionColumn',
           'template' => '{update} {delete}',
           ]
        ],
    ]); ?>
</div>
