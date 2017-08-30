<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TBooking */

$this->title = 'Update Tbooking: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tbookings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbooking-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
