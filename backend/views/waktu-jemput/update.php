<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WaktuJemput */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Waktu Jemput',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Waktu Jemputs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="waktu-jemput-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'Destinasi'=>$Destinasi,
                'Lokasi'=>$Lokasi,
    ]) ?>

</div>
