<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TBookingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
//this my change
$this->title = 'BOOKING DATA';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$this->registerJs("
$(document).ready(function(){

})
$('#filter').on('click',function(){
    $('#search-form').toggle(300);
});
    ");

 ?>

<div class="tbooking-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="col-md-12">
   <center><strong id="filter" class="btn btn-block btn-success">Filter Data</strong></center>
     <div id="search-form" style="display:none" > <?= $this->render('_search', [
        'searchModel' => $searchModel,
        'noOrder'=>$noOrder,
        'des'=>$des,
        'sts'=>$sts,
        'customer'=>$customer, 
        ]) ?>
    </div>

    <div class="col-md-3"><br>
    <?= Html::label('Update By Checked','', ['class' => 'control-label']); ?>
    <?= Html::dropDownList('status','',$sts,[
        'prompt'=>'--> Select Option <--',
        'class'=>'form-control',
        'id'=>'form-sts',
        'onchange'=>'
            var sts = $(this).val();
            var keys = $("#grid-booking").yiiGridView("getSelectedRows");
            if (sts == "" || keys == "") {
                $("#btn-submit").hide(200);
            }else{
                 $("#btn-submit").show(200);
            }',
        ])?>

    <div class="form-group">
    <?= Html::a('Submit',null, [
            'id'=>'btn-submit',
            'style'=>'display:none',
            'class' => 'btn btn-success',
            'onclick'=>'
        var keys = $("#grid-booking").yiiGridView("getSelectedRows");
        var sts = $("#form-sts").val();
       
        if (keys == "" ) {
            alert("Please Select Checkbox First");
        }else{
            $("#load").html("<center><img src=../../line.svg width=75 height=75></center>");
            $("#load").show(500);
            $.ajax({
                url: "'.Url::to(["check-update"]).'",
                type: "POST",
                async: true, 
                data: {blk:keys, status:sts},
                success: function() {
                    $("#btn-submit").hide(100);
                    $("#form-sts").val("");
                    $("#load").hide(500);
                    $("#load").html("");
                    $.pjax.reload({container:"#pjax-booking"});

                }, 
                        
            });
        }
    '
    ]);?>
    </div>
    
</div>
<div id="div-mail" class="col-md-3"><br>
 <?= Html::label(' Supplier','', ['class' => 'control-label glyphicon glyphicon-envelope']); ?>
 <div class="form-group">
    <?= Html::button('', [
        'class' => 'btn btn-success glyphicon glyphicon-send',
        'id'=>'btn-mail',
        'onclick'=>'
                var keys = $("#grid-booking").yiiGridView("getSelectedRows");
               
                if (keys == "") {
                    
                }else{
                $("#div-mail").hide(200);
                $("#load").html("<center><img src=../../line.svg width=75 height=75></center>");
                $("#load").show(500);
                    $.ajax({
                        url: "'.Url::to(["remind-supplier"]).'",
                        type: "POST",
                        async: true, 
                        data: {idb:keys},
                        success: function() {
                            $("#load").hide(500);
                            $("#load").html("");
                            $("#div-mail").show(200);
                        }, 
                    
                    });
                }
            ',
        ]); ?>
</div>
</div>
<div style="display:none" class="col-md-12" id="load"></div>
</div>
<div style="display:none">
<?php  echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
   // 'columns' => $gridColumns,
     'target'=> ExportMenu::TARGET_BLANK,
    'columnSelectorOptions'=>[
        'label' => 'Cols...',
    ],
    
    'fontAwesome' => true,
    'dropdownOptions' => [
        'label' => 'Export All',
        'class' => 'btn btn-default'
    ]
]);
 ?>
 </div>
<div class="col-md-12">


<?php Pjax::begin(['id'=>'pjax-booking']); ?>
<?php  echo GridView::widget([
        'id'=>'grid-booking',

        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'showPageSummary'=>true,
        'pjax'=>true,
        'striped'=>true,
        'hover'=>false,
        'export'=>['target'=>GridView::TARGET_SELF],

            'exportConfig' => [

        GridView::EXCEL => ['label' => 'EXCEL'],
      //  GridView::HTML => ['label' => 'PDF'],//[// html settings],
      //  GridView::PDF => //[// pdf settings],
    ],
        'panel'=>['type'=>'primary', 'heading'=>''],
        'columns'=>[
            ['class'=>'kartik\grid\SerialColumn'],
            [
                'attribute'=>'tgl_trip', 
                'width'=>'100%',
                'format'=>'raw',
                'value'=>function ($model, $key, $index, $widget) { 
                    return "<strong>Tanggal ".date('d-m-Y', strtotime($model->tgl_trip))."</strong>";
                },
               
               
             
                'group'=>true,  // enable grouping,
                'groupedRow'=>true,                    // move grouped column to a single grouped row
                'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
                'groupEvenCssClass'=>'kv-grouped-row', // configure even group cell css class
                'groupFooter'=>function ($model, $key, $index, $widget) { // Closure method
                    return [
                        'mergeColumns'=>[[0,2]], // columns to merge in summary
                        'content'=>[             // content to show in each summary cell
                            0=>'Jumlah per Tanggal  (' . date('d-m-Y', strtotime($model->tgl_trip)) . ')',
                           7=>GridView::F_SUM,
                            9=>GridView::F_SUM,
                           // 6=>GridView::F_SUM,
                        ],
                        'contentFormats'=>[      // content reformatting for each summary cell
                            //4=>['format'=>'number', 'decimals'=>2],
                           7=>['format'=>'number', 'decimals'=>0],
                            9=>['format'=>'number', 'decimals'=>2],
                        ],
                        'contentOptions'=>[      // content html attributes for each summary cell
                        //    0=>['style'=>'font-variant:small-caps'],
                            //8=>['style'=>'text-align:left'],
                            9=>['style'=>'text-align:right'],
                           
                           // 6=>['style'=>'text-align:right'],
                        ],//
                        // html attributes for group summary row
                        'options'=>['class'=>'primary','style'=>'font-weight:bold;']
                    ];
                }
            ],
                 [   
                'attribute'=>'idDestinasi.nama_destinasi', 
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->idDestinasi->nama_destinasi;
                },
              //  'contentOptions'=>['style'=>'vertical-align: center;'],
                'vAlign'=>'middle',
                'pageSummary'=>'TOTAL KESELURUHAN',
               
                
                'group'=>true,  // enable grouping
                'subGroupOf'=>1, // supplier column index is the parent group,
                'groupFooter'=>function ($model, $key, $index, $widget) { // Closure method
                    return [
                        'mergeColumns'=>[[2, 3]], // columns to merge in summary
                        'content'=>[              // content to show in each summary cell
                            2=>'Jumlah  (' . $model->idDestinasi->nama_destinasi . ')',
                           7=>GridView::F_SUM,
                            9=>GridView::F_SUM,
                           // 6=>GridView::F_SUM,
                        ],
                        'contentFormats'=>[      // content reformatting for each summary cell
                          
                          7=>['format'=>'number', 'decimals'=>0],
                           9=>['format'=>'number', 'decimals'=>2],
                        ],
                        'contentOptions'=>[      // content html attributes for each summary cell
                            //4=>['style'=>'text-align:right'],
                           //8=>['style'=>'text-align:right'],
                           9=>['style'=>'text-align:right'],
                        ],
                        // html attributes for group summary row
                        'options'=>['class'=>'success','style'=>'font-weight:bold;']
                    ];
                },
            ],
            [
                'header'=>'No Order',
                'format'=>'raw',
                'value'=>function($model){
                    return "<strong>".$model->id."</strong>";
                },
                'width'=>'50px',
                
            ],
            [
                //'attribute'=>'unit_price',
                'header'=>'Leader',
                'format'=>'raw',
                'value'=>function($model){
                    return $model->idCustomer->nama_customer;
                }
                
            ],
            [
                //'attribute'=>'unit_price',
                'header'=>'No-Telp',
                'format'=>'raw',
                'value'=>function($model){
                    return $model->idCustomer->no_telp;
                }
                
            ],
            [
                'header'=>'Email',
                 'format'=>'email',
                'value'=>function($model){
                    return $model->idCustomer->email;
                }

            ],

            [
                'header'=>'Pax',

                'value'=>function($model){
                    return $model->total_pax;
                },
                'pageSummary'=>true,
                'pageSummaryFunc'=>GridView::F_SUM
            ],
            ['header'=>'Cur',
            'hAlign'=>'right',
            'width'=>'25px',
            'value'=>function($model){
                if (isset($model->tPembayaran)) {
                    return $model->tPembayaran->currency;
                    
                }else{
                   // var_dump($model->tPembayaran->currency);
                  return "-";
                }
                },],
            [
                'header'=>'Price',
                'headerOptions'=>['style'=>'text-align: center;','width'=>'10%'],
                'width'=>'75px',
                'hAlign'=>'right',
                'format'=>['decimal',2],
                'value'=>function($model){
                    return $model->total_biaya;
                },
                'pageSummary'=>true,
                'pageSummaryFunc'=>GridView::F_SUM
            ],
            ['header'=>'Status',
            'width'=>'50px',
            'value'=>'idStatus.status'],
            ['class' => 'kartik\grid\CheckboxColumn'],
            
        ],
    ]);


?>
    <?php Pjax::end(); ?>
    </div>

</div>
