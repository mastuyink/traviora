<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TMainCarrousel */

$this->title = 'Create Tmain Carrousel';
$this->params['breadcrumbs'][] = ['label' => 'Tmain Carrousels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tmain-carrousel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
