<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\WaktuJemput */

$this->title = Yii::t('app', 'Create Waktu Jemput');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Waktu Jemputs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="waktu-jemput-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'Destinasi'=>$Destinasi,
         'Lokasi'=>$Lokasi,
    ]) ?>

</div>
