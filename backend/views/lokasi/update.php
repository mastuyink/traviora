<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TLokasiAj */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Tlokasi Aj',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tlokasi Ajs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tlokasi-aj-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
