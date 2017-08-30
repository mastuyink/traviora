<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TLiburTrip */

$this->title = Yii::t('app', 'Create Tlibur Trip');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tlibur Trips'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tlibur-trip-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'des'=>$des,
    ]) ?>

</div>
