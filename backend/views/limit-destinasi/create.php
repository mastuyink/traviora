<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TLimitDestinasi */

$this->title = Yii::t('app', 'Create Tlimit Destinasi');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tlimit Destinasis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tlimit-destinasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'Destinasi'=>$Destinasi,
    ]) ?>

</div>
