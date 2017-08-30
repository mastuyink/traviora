<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TPost */

$this->title = Yii::t('app', 'Create Tpost');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tposts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tpost-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'destinasi' => $destinasi,
    ]) ?>

</div>
