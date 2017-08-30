<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TSesiBiaya */

$this->title = Yii::t('app', 'Create Tsesi Biaya');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tsesi Biayas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tsesi-biaya-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelSesi' => $modelSesi,
        'jenisSesi'=>$jenisSesi,
        'modelBiaya'=>$modelBiaya,
        'Destinasi'=>$Destinasi,
    ]) ?>

</div>
