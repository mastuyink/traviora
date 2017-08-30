<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TMainCarrouselSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Carrousel Utama';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tmain-carrousel-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('', ['create'], ['class' => 'btn btn-danger btn-lg glyphicon glyphicon-plus']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'path',
            'size',
            'time',

            ['class' => 'yii\grid\ActionColumn',
            'template'=>'{update} {delete}'
            ],
        ],
    ]); ?>
</div>
