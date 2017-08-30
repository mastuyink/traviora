<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TExtraData */

$this->title = Yii::t('app', 'Tambah Extra Data');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Extra Data'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="textra-data-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
