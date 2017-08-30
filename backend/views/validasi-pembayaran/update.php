<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TPost */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Tpost',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tposts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tpost-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'destinasi' => $destinasi,
    ]) ?>

</div>
