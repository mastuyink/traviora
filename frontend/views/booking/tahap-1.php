
<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\label\LabelInPlace;


/* @var $this yii\web\View */
/* @var $model app\models\TBooking */

$this->title = "Leader Info";
//$this->params['breadcrumbs'][] = ['label' => 'Tbookings', 'url' => ['index']];
$config = ['template'=>"{input}\n{error}\n{hint}"];
?>
<?php
$this->registerJs("
$(document).ready(function(){
 $('#ttraveler-0-nama').prop('readonly', true);
	$('#tcustomer-nama_customer').blur(function(){
	var lead = $('#tcustomer-nama_customer').val();
	$('#ttraveler-0-nama').val(lead);

});
});
");?>
<div class="tbooking-view">

<div class=" container col-md-12">
	<div class="panel panel-default">
      <div class="panel-heading"><center><strong class="glyphicon glyphicon-plane">Your Trip</strong></center></div>
       <ul class="list-group">
      	 	<li class="list-group-item"><center><h3><strong><?= $session['destinasi.nama_destinasi'];  ?></strong></h3></center></li>
 			<li class="list-group-item"><center><h4><strong><?= date('d-m-Y',strtotime($session['booking.tgl_trip']));  ?></strong></h4></center></li>
		</ul>

		</div>
<?php $form = ActiveForm::begin(); ?>
<div class=" container col-md-12">
<div class="col-md-12">
	<div class="panel panel-primary">
      <div class="panel-heading "><center class="glyphicon glyphicon-user"> LEADER CONTACT</center></div>
        <div class="panel-body">
 			
			<?= $form->field($modelCustomer, 'nama_customer',$config)->widget(LabelInPlace::classname(),
                [
               
                'class'=>'form-control leader',
                'defaultIndicators'=>false,
                'encodeLabel'=> false,
              	'label'=>'<i class="glyphicon glyphicon-user"></i> Leader Name',
                ]
                ) ?>
			<?= $form->field($modelCustomer, 'no_telp',$config)->widget(LabelInPlace::classname(),
                [
               'defaultIndicators'=>false,
               'encodeLabel'=> false,
               'label'=>'<i class="glyphicon glyphicon-phone"></i> Phone Number',
                
                ]
                ); 
                ?>
			<?= $form->field($modelCustomer, 'email',$config)->widget(LabelInPlace::classname(),
                [
                'defaultIndicators'=>false,
                'encodeLabel'=> false,
              	'label'=>'<i class="glyphicon glyphicon-envelope"></i> E-mail',
                ]
                ); 
                ?>
		</div>                                                            
	</div>
</div>
<div class="col-md-12">
	<div class="panel panel-primary">
      <div class="panel-heading">NAME TRAVELER</div>
        <div class="panel-body">
 			
			<?php 
			echo "<h5> ADULT TRAVELER </h5>";
			foreach ($modelTraveler as $index => $setting) {
				echo $form->field($setting, "[$index]nama",$config)->textInput(['placeholder'=>'Name Adult Traveler'])->label('');
			} 
			if ($anak+0 >= 1) {
				echo "<h5> CHILDREN TRAVELER </h5>";
				foreach ($TravelerAnak as $key => $val) {
					echo $form->field($val, "[$key]nama",$config)->textInput(['placeholder'=>'Name Child Traveler']);
				}
			} 

			if ($bayi+0 >= 1) {
				foreach ($Travelerbayi as $key => $val) {
				echo "<h5> INFANT TRAVELER </h5>";
				echo $form->field($val, "[$key]nama",$config)->textInput(['placeholder'=>'Name Infant Traveler']);
				}
			}
			?>
			
		</div>                                                            
	</div>
</div>
</div>


		
	
</div>

<div class="form-group col-md-12">
        <?= Html::submitButton(Yii::t('app', 'NEXT STEP'), ['class' => 'btn btn-lg btn-block btn-warning']) ?>
    </div>
<?php ActiveForm::end();
    ?>
</div>

