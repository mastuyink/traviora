<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TDestinasi */

$this->title = Yii::t('app', 'Tambah Destinas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Destinasi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tdestinasi-create">


    <?= $this->render('_form', [
        'model' => $model,
        'jenisd'=>$jenisd,
        'hariTrip'=>$hariTrip,
        'lokasi'=>$lokasi,
        'supplier'=>$supplier,
        'liburTtrip'=>(empty($liburTtrip)) ? [new TLiburTrip] : $liburTtrip,
    ]) ?>

</div>
