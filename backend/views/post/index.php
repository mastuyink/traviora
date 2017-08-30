<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TPostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ARTIKEL');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tpost-index">

    <center><h1><strong><?= Html::encode($this->title) ?></strong></h1></center>
   

    <p>
        <?= Html::a(Yii::t('app', 'Create Tpost'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
     <p>
        <?= Html::a(Yii::t('app', 'Tambah'), Yii::$app->urlManagerFrontend->baseUrl, ['class' => 'btn btn-danger']) ?>
    </p>
    <a href="'http://home.travel.com/post/home'">Coba</a>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'judul_content:ntext',
            'idDestinasi.nama_destinasi',
            
            // 'content:ntext',
            'idAuthor.username',
            'create_at',
            'last_update',
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
