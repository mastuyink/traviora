<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use yii\widgets\Pjax;
use kartik\grid\EditableColumn;
use kartik\grid\DataColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TDestinasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'DAFTAR DESTINASI / PAKET WISATA');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tdestinasi-index">

    <p>
        <?= Html::a(Yii::t('app', ''), ['create'], ['class' => 'btn btn-lg btn-danger glyphicon glyphicon-plus']) ?>
    </p>

    <div class="col-md-12">
      <?= $this->render('_search', [
        'searchModel' => $searchModel,
        'jenisd'=>$jenisd,
        'Des'=>$Des
       // 'noOrder'=>$noOrder,
       // 'des'=>$des,
       // 'sts'=>$sts
    ]) ?>
</div>
<?php Pjax::begin(['id' => 'grid-booking']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
             [
                
                'width'=>'100%',
                'format'=>'raw',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->idSupplier->nama;
                },
               
               
             
                'group'=>true,  // enable grouping,
                'groupedRow'=>true,                    // move grouped column to a single grouped row
                'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
                'groupEvenCssClass'=>'kv-grouped-row', // configure even group cell css class
              
            ],
            'idLokasiDestinasi.lokasi',
            'idJenisDestinasi.jenis_destinasi',
            'nama_destinasi',
            'jatah_seat',
            'stok_seat',
            'seat_terjual',
            'min_pax',
            'max_pax',
            'main_limit',

            [
            'header'=>'Senin',
            'format'=>'raw',
            'value'=>function($hari){
                if ($hari->tHariTrip->id_senin == 100) {
                    return Html::label('', "", ['class'=>'glyphicon glyphicon-ok']);
                }else{
                return Html::label('-' /* ['class'=>'glyphicon glyphicon-remove']*/);
                } 
            },
            ],

            [
            'header'=>'Selasa',
            'format'=>'raw',
            'value'=>function($hari){
                if ($hari->tHariTrip->id_selasa == 100) {
                    return Html::label('', "", ['class'=>'glyphicon glyphicon-ok']);
                }else{
                return Html::label('-'/* ['class'=>'glyphicon glyphicon-remove']*/);
                } 
            },
            ],

            [
            'header'=>'Rabu',
            'format'=>'raw',
            'value'=>function($hari){
                if ($hari->tHariTrip->id_rabu == 100) {
                    return Html::label('', "", ['class'=>'glyphicon glyphicon-ok']);
                }else{
                return Html::label('-' /* ['class'=>'glyphicon glyphicon-remove']*/);
                } 
            },
            ],

            [
            'header'=>'Kamis',
            'format'=>'raw',
            'value'=>function($hari){
                if ($hari->tHariTrip->id_kamis == 100) {
                    return Html::label('', "", ['class'=>'glyphicon glyphicon-ok']);
                }else{
               return Html::label('-' /* ['class'=>'glyphicon glyphicon-remove']*/);
                } 
            },
            ],

            [
            'header'=>'Jumat',
            'format'=>'raw',
            'value'=>function($hari){
                if ($hari->tHariTrip->id_jumat == 100) {
                    return Html::label('', "", ['class'=>'glyphicon glyphicon-ok']);
                }else{
                return Html::label('-' /* ['class'=>'glyphicon glyphicon-remove']*/);
                } 
            },
            ],

            [
            'header'=>'Sabtu',
            'format'=>'raw',
            'value'=>function($hari){
                if ($hari->tHariTrip->id_sabtu == 100) {
                    return Html::label('', "", ['class'=>'glyphicon glyphicon-ok']);
                }else{
                return Html::label('-' /* ['class'=>'glyphicon glyphicon-remove']*/);
                } 
            },
            ],

            [
            'header'=>'Minggu',
            'format'=>'raw',
            'value'=>function($hari){
                if ($hari->tHariTrip->id_minggu == 100) {
                   return Html::label('', "", ['class'=>'glyphicon glyphicon-ok']);
                }else{
                return Html::label('-' /* ['class'=>'glyphicon glyphicon-remove']*/);
                } 
            },
            ],
          //  'idStatus.status',
            /*['header'=>'Status',
            'format'=>'raw',
            'value'=>function($status){
                     return SwitchInput::widget([
                             'model' => $status,
                             'attribute' => 'id_status',
                             'type' => SwitchInput::CHECKBOX,
                             'options'=>['uncheck' => 2,
                             'value'=>1],
                             'pluginOptions' => ['size' => 'mini']
                             ]);

                             $form->field($model, 'id_status')->widget(SwitchInput::classname(), [
    'options'=>['uncheck' => 2,'value'=>1,],
    'type' => SwitchInput::CHECKBOX
    ]);
            }],*/
  
            ['header'=>'Status',
            'format'=>'raw',
            'value'=>function($status){
                     if ($status->id_status == 1) {
                         return "<strong style='color: green;'>ON</strong>"; 
                     }elseif($status->id_status == 3){
                        return "<strong style='color: orange;'>".$status->idStatus->status."</strong>";
                     }else{
                         return "<strong style='color: red;'> OFF</strong>";
                     }
            }],
            
            ['header'=>'Confirm',
            'value'=>'idJenisKonfirmasi.jenis_konfirmasi'],


            // 'timestamp',

            ['class' => 'yii\grid\ActionColumn',
            'template'=>'{update}{delete}'],
        ],
    ]); ?>
<?php Pjax::end() ?>
</div>
