<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TExtraData */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Extra Data',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Extra Data'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="textra-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
