<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TBiayaKhusus */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Tarif Khusus',
]) . $modelKhusus->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tarif Khususes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tbiaya-khusus-update">


    <?= $this->render('_form', [
        'modelKhusus' => $modelKhusus,
        'modelBiaya'=>$modelBiaya,
        'Destinasi'=>$Destinasi,
    ]) ?>

</div>
