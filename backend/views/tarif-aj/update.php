<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TarifAj */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Tarif Aj',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tarif Ajs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tarif-aj-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
		'model'     => $model,
		'Destinasi' => $Destinasi,
		'Area'      => $Area,
		'jenis'     => $jenis,
		'Lokasi'    => $Lokasi,
    ]) ?>

</div>
