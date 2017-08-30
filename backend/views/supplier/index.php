<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SupplierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Supplier');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tsupplier-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('', ['create'], ['class' => 'btn btn-lg btn-danger glyphicon glyphicon-plus']) ?>
    </p>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'nama',
            'alamat',
            'no_telp',
            'email:email',
            'site',
            'create_at',
            'update_at',

            ['class' => 'yii\grid\ActionColumn',
            'template'=>'{update} - {delete}'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
