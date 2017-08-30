<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TarifAj */

$this->title = Yii::t('app', 'Create Tarif Aj');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tarif Ajs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tarif-aj-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'Destinasi'=>$Destinasi,
        'Area'=>$Area,
        'jenis'=>$jenis,
        'Lokasi'=>$Lokasi,
    ]) ?>

</div>
