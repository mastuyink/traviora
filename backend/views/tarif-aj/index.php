<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\Caritarif */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tarif Ajs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tarif-aj-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tarif Aj'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           
            'idDestinasi.nama_destinasi',
            'idArea.nama_area',
            'idLokasi.lokasi_aj',
            'idJenisTarif.jenis_tarif',
            'tarif_pax:currency',
            'tarif_car:currency',
            'tarif_elf:currency',
            'datetime:datetime',

            ['class' => 'yii\grid\ActionColumn',
            'template'=>'{update} - {delete}'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
