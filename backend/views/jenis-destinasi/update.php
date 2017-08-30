<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TJenisDestinasi */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Jenis Destinasi',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jenis Destinasi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tjenis-destinasi-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
