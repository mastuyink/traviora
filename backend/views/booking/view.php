<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TBooking */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tbookings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbooking-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_destinasi',
            'id_customer',
            'tgl_trip',
            'waktu_booking',
            'waktu_exp',
            'total_pax',
            'biaya_trip',
            'biaya_jemput',
            'biaya_antar',
            'total_biaya',
            'id_status',
            'timestamp',
        ],
    ]) ?>

</div>
