<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use kartik\widgets\AlertBlock;

/* @var $this yii\web\View */
/* @var $modelPembayaran app\models\TPembayaran */
/* @var $form yii\widgets\ActiveForm */
$modelpembayaran->id_metode = 1;
?>
<?php
$this->registerJs("
$(document).ready(function(){
  $('#drop-pay').val('');
});
  ");
?>



<!DOCTYPE html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
</head>

<body>
    

    <script>
        

    </script>
</body>


<div class="tpembayaran-form">

    <?php $form = ActiveForm::begin(); ?>
<?php echo AlertBlock::widget([
            'useSessionFlash' => true,
            'type' => AlertBlock::TYPE_GROWL
            ]);
      ?>
    

<div class="col-md-12">
    <div class="col-md-6 col-md-offset-3">
<div class="panel panel-primary">
      <div class="panel-heading">Choose Your Payment</div>
      <center><h3><?= $session['currency.id']." ".$session['booking.total_biaya'] ?></h3></center>
          <div class="panel-body">
           <?=  
           $form->field($modelpembayaran, 'id_metode')->radioList($metode_bayar,[
            'id'=>'rad-method',
            'onchange'=>'
              var metod = $("#rad-method :radio:checked").val();
              if (metod == "") {
            $("#hasil-ajax").fadeOut(200);
            $("#hasil-ajax").html("");
            $("#div-submit").hide(300);

          }
          if (metod == 1) {
            $("#hasil-ajax").fadeOut(200);
            $("#hasil-ajax").html("");
            $("#div-submit").show(300);

          }

          if (metod == 2) {
            $("#div-submit").hide(300);
            $("#hasil-ajax").fadeIn(200);
            $.ajax({
                     url : "'.Url::to(["paypal"]).'",
                     type: "POST",
                     success: function (div) {
                     $("#hasil-ajax").html(div);

                     },
                   });
          }'
            ]) ?>
         
          
    </ul></center>
<div id="div-submit" class="form-group">
        <?= Html::submitButton( Yii::t('app', 'Confirm') , ['id'=>'btn-trasanfer','class' => 'btn btn-block btn-lg btn-warning']) ?>
    
    </div>
</div>
    <center><ul style="display: none;" id="hasil-ajax" class="list-group">
    
</div>
</div>
</div> 

    

    <?php ActiveForm::end(); ?>

</div>