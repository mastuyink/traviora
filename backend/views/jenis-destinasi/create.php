<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TJenisDestinasi */

$this->title = Yii::t('app', 'Tambah Kategori Destinasi');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jenis Destinasi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tjenis-destinasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
