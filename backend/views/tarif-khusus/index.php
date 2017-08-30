<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use mdm\admin\components\Helper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TBiayaKhususSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Harga Khusus / Event');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbiaya-khusus-index">

    <center><h1><strong><?= Html::encode($this->title) ?></strong></h1></center>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', ''), ['create'], ['class' => 'btn-lg btn-danger glyphicon glyphicon-plus']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

         
            'idDestinasi.nama_destinasi',
            'event',
            'tgl_event:date',
            'idBiaya.biaya_dewasa:currency',
            'idBiaya.biaya_anak:currency',
            'idBiaya.biaya_bayi:currency',
             'datetime:datetime',

            ['class' => 'yii\grid\ActionColumn',
            'template' => Helper::filterActionColumn('{update} {delete}'),],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
