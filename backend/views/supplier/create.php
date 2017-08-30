<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TSupplier */

$this->title = Yii::t('app', 'Tambah Supplier');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Supplier'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tsupplier-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
