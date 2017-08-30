<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AreaAj */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Area Aj',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Area Ajs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="area-aj-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'lokasi'=>$lokasi,
    ]) ?>

</div>
