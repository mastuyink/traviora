<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AreaAj */

$this->title = Yii::t('app', 'Create Area Aj');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Area Ajs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="area-aj-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
           'lokasi'=>$lokasi,
    ]) ?>

</div>
