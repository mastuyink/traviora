<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\growl\Growl;
use kartik\widgets\AlertBlock;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel app\models\TPostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Validasi Pembayaran');
$this->params['breadcrumbs'][] = $this->title;

?>
  <div class="col-md-12">

   <?php echo $this->render('_search', [
            'model' => $searchModel,
            'pencarian'=>$pencarian,
            'pengirim'=>$pengirim]); ?>

   </div>
<div class="tpost-index">

    
<?php echo AlertBlock::widget([
            'useSessionFlash' => true,
            'type' => AlertBlock::TYPE_GROWL
            ]);
      ?>
     <?php Pjax::begin(['id'=>'pjax-validasi']); ?>  
    <?= GridView::widget([
        
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['header'=>'No',
            'class' => 'yii\grid\SerialColumn'],

            ['header'=>'Code',
            'width'=>'50px',
            'value'=>'id'],
            'idDestinasi.nama_destinasi',
            //'tgl_trip:date',
            //'total_pax',
            ['header'=>'Tagihan',
            'format'=>'raw',
            'value'=>function($model){
                return $model->idPembayaran->currency." ".$model->idBooking->total_biaya;
            }],
           // 'idPembayaran.currency',
            //'idStatus.status',
           
            'idPembayaran.idMetode.metode',
            'nama_pengirim',
            'jumlah_kirim:currency',
            'tgl_kirim:date',
            'waktu_booking',
            'waktu_konfirmasi',
            'waktu_exp',

            ['header'=>'Aksi',
            'format'=>'raw',
            'value'=>function($model){
                return  Html::button('Valid', [
                    'class'=>'btn-sm btn-primary btn-valid',
                    'onclick'=>'
                    $($(this)).prop("disabled",true);
                    var no = $(this).val();
                    $($(this)).text("  ");
                    $($(this)).removeClass("btn-primary");
                    $($(this)).addClass("btn-md btn-danger glyphicon glyphicon-time");
                    $.ajax({
                        url: "'.Url::to(['valid']).'",
                        type: "POST",
                        async: "true", 
                        data: {nomor:no},
                        container: "#pjax-validasi",
                        timeout: 100000,
                        success: function (data) {
                        location.reload();
                        $("#alert").html(data);
                        $("#alert").hide(500);
                        }, 
                    });',
                    'value'=>$model->id]);
            }
            ],
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?> 
    <?php Pjax::end(); ?>

    
    <div id="alert"></div>
</div>
