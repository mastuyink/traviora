<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TDestinasi */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Tdestinasi',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tdestinasis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

?>
<div class="tdestinasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'jenisd'=>$jenisd,
        'hariTrip'=>$hariTrip,
        'lokasi'=>$lokasi,
        'supplier'=>$supplier,
        'liburTtrip'=>(empty($liburTtrip)) ? [new TLiburTrip] : $liburTtrip,
    ]) ?>

</div>
