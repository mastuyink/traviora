<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use mdm\admin\components\Helper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TSesiBiayaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Trip Season');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tsesi-biaya-index">

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
            [
               
                'width'=>'100%',
                'format'=>'raw',
                'value'=>function ($model, $key, $index, $widget) { 
                    return "<i>".$model->idDestinasi->idSupplier->nama."</i> - <strong> ".$model->idDestinasi->nama_destinasi."</strong>";
                },
                 'group'=>true,  // enable grouping,
                'groupedRow'=>true,                    // move grouped column to a single grouped row
                'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
                'groupEvenCssClass'=>'kv-grouped-row', // configure even group cell css class
            ],
   
            'idJenisSesi.jenis_sesi',
            'tgl_mulai:date',
            'tgl_selesai:date',
            'idBiaya.biaya_dewasa:currency',
            'idBiaya.biaya_anak:currency',
            'idBiaya.biaya_bayi:currency',
            'datetime:datetime',

            ['class' => 'yii\grid\ActionColumn',
            'template' => Helper::filterActionColumn('{update} {delete}'),],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
