<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TSesiBiaya */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Tsesi Biaya',
]) . $modelSesi->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tsesi Biayas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelSesi->id, 'url' => ['view', 'id' => $modelSesi->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tsesi-biaya-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelSesi' => $modelSesi,
        'jenisSesi'=>$jenisSesi,
        'modelBiaya'=>$modelBiaya,
        'Destinasi'=>$Destinasi,
    ]) ?>

</div>
