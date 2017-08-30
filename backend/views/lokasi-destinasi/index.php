<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LokasiDestinasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'lokasi Destinasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lokasi-destinasi-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('', ['create'], ['class' => 'btn btn-danger btn-lg glyphicon glyphicon-plus']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'lokasi',
            'datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
