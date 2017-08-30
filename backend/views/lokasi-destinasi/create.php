<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LokasiDestinasi */

$this->title = 'Tambah Lokasi Destinasi';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lokasi Destinasis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lokasi-destinasi-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
