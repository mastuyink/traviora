<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TBookingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbookings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbooking-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

<div class="col-md-12">
      <?= $this->render('_search', [
        'searchModel' => $searchModel,
        'noOrder'=>$noOrder,
        'des'=>$des,
        'sts'=>$sts,
        'customer'=>$customer,
    ]) ?>
</div>

<?php Pjax::begin(['id'=>'pjax-booking']); ?>


<?php
    $gridColumns = [
             [
             'header'=>'No',
              'class' => 'kartik\grid\SerialColumn'
             ],
             ['header'=>'Nomor Order',
             'value'=>'id'
             ],
             'idDestinasi.nama_destinasi',
             'idCustomer.nama_customer',
             
             ['header'=>'Tanggal Trip',
             'value'=>'tgl_trip',
             'format'=>'date'],
             
             ['header'=>'Pax',
             'value'=>'total_pax'],
             
            /* ['header'=>'Total Biaya',
             'value'=>'total_biaya',
             'hAlign'=>'right',
             'format'=>'currency'],*/

             ['header'=>'Total Biaya',
             'format'=>'raw',
             'value'=>function($model){
                return "<h7 class='pull-left'>Rp </h7> <h7 class='pull-right'>".number_format($model->total_biaya,0)."</h7>";
             }
             ],
             
             ['header'=>'Waktu Booking',
             'value'=>'waktu_booking',
             'format'=>'datetime'],
             //'biaya_trip:currency',
             //'biaya_jemput:currency',
             // 'biaya_antar:currency',
             //'total_biaya:currency',
             /*['header'=>'Exp',
             'value'=>'waktu_exp'],*/
             
             
             'idStatus.status',
             ['class' => 'yii\grid\ActionColumn'],
    ]; ?>

<?= ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'fontAwesome' => true,
    'target'=> ExportMenu::TARGET_SELF,
    //'showConfirmAlert'=>false,
    'exportConfig'=> [
        ExportMenu::FORMAT_CSV => false,
        ExportMenu::FORMAT_TEXT => false,
        ExportMenu::FORMAT_HTML => false,
        ExportMenu::FORMAT_EXCEL => false,
        ExportMenu::FORMAT_PDF => [
        'label' => 'PDF',
        'icon' =>'book',
        'iconOptions' => ['class' => 'text-danger'],
        'linkOptions' => [],
        'options' => ['title' =>'LAPORAN PDF'],
        'alertMsg' => 'laporan anda akan siap di download',
        'mime' => 'application/pdf',
        'extension' => 'pdf',
        'writer' => 'PDF'
    ],
        ExportMenu::FORMAT_EXCEL_X => [
        'filename' => 'Report Booking',
        'label' => 'Excel 2007 +',
        'icon' => 'plus',
        'iconOptions' => ['class' => 'text-success'],
        'linkOptions' => [],
        'options' => ['title' => 'Report Booking Excel'],
        'alertMsg' => 'Data Akan Disimpan dalam bentuk Excel',
        'mime' => 'application/application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'extension' => 'xlsx',
        'writer' => 'Excel2007'
    ],
    ],
    //'showConfirmAlert'=>false,
    'dropdownOptions' => [
        'label' => 'Export Table ',
        'class' => 'btn btn-primary'
    ]
]);?> 

<?=  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'responsive'   =>true,
        'hover'        =>true,
        'pjax'         =>true,
        'pjaxSettings' =>[
        'neverTimeout' =>true,
        'beforeGrid'   =>'Sebelum Pjax',
        'afterGrid'    =>'Setelah Pjax',
        ],
            'columns' => $gridColumns,
    'toolbar'=>[
        '{export}',
        '{toggleData}'
    ],
    /*
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['header'=>'Nomor Order',
            'value'=>'id'],
            'idDestinasi.nama_destinasi',
            'idCustomer.nama_customer',

            ['header'=>'Tanggal Trip',
            'value'=>'tgl_trip'],

            ['header'=>'Total Pax',
            'value'=>'total_pax'],

            ['header'=>'Total Biaya',
            'value'=>'total_biaya'],

            ['header'=>'Waktu Booking',
            'value'=>'waktu_booking'],
            //'biaya_trip:currency',
            //'biaya_jemput:currency',
           // 'biaya_antar:currency',
            //'total_biaya:currency',
            ['header'=>'Exp',
            'value'=>'waktu_exp'],
            
            
            'idStatus.status',
            
            // 'timestamp',*/

           
       // ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
