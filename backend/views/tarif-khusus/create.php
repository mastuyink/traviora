<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TBiayaKhusus */

$this->title = Yii::t('app', 'Create Tarif Khusus');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tarif Khususes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbiaya-khusus-create">

    <?= $this->render('_form', [
        'modelKhusus' => $modelKhusus,
        'modelBiaya'=>$modelBiaya,
        'Destinasi'=>$Destinasi,

    ]) ?>

</div>
