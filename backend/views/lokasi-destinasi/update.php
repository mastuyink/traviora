<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LokasiDestinasi */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Lokasi Destinasi',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lokasi Destinasi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="lokasi-destinasi-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
