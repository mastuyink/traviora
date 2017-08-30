<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TSupplier */

$this->title = Yii::t('app', 'Update {modelClass}:  No: ', [
    'modelClass' => 'Supplier',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Suppliers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tsupplier-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
