<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TLokasiAj */

$this->title = Yii::t('app', 'Create Lokasi');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lokasi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tlokasi-aj-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
