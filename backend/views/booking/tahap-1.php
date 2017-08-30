<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\TBooking */

$this->title = "Leader Info";
//$this->params['breadcrumbs'][] = ['label' => 'Tbookings', 'url' => ['index']];
var_dump($session['booking.biaya_trip']);
?>
<?php
$this->registerJs("
$(document).ready(function(){
 $('#ttraveler-0-nama').prop('readonly', true);
	$('.leader').blur(function(){
	var lead = $('.leader').val();
	$('#ttraveler-0-nama').val(lead);

});
});
");?>
<div class="tbooking-view">

<div class="col-md-12">
<div class="col-md-12">
	<div class="panel panel-default">
      <div class="panel-heading"><center><strong class="glyphicon glyphicon-plane"> DESTINASI</strong></center></div>
       <ul class="list-group">
      	 	<li class="list-group-item"><center><h3><strong><?= $session['destinasi.nama_destinasi'];  ?></strong></h3></center></li>
 			<li class="list-group-item"><center><strong><?= date('d-m-Y',strtotime($session['booking.tgl_trip']));  ?></strong></center></li>		
		</ul>                                                      
	</div>
</div>
</div>
<?php $form = ActiveForm::begin(); ?>
<div class="col-md-12">
<div class="col-md-6">
	<div class="panel panel-primary">
      <div class="panel-heading "><center class="glyphicon glyphicon-user"> LEADER CONTACT</center></div>
        <div class="panel-body">
 			
			<?= $form->field($modelCustomer, 'nama_customer')->textInput(['id'=>'leader','class'=>'form-control leader','readonly']) ?>
			<?= $form->field($modelCustomer, 'no_telp')->textInput() ?>
			<?= $form->field($modelCustomer, 'email')->textInput() ?>
		</div>                                                            
	</div>
</div>
<div class="col-md-6">
	<div class="panel panel-primary">
      <div class="panel-heading">TRAVELER DEWASA</div>
        <div class="panel-body">
 			
			<?php foreach ($modelTraveler as $index => $setting) {

    echo $form->field($setting, "[$index]nama")->textInput()->label("$index"+1);
} ?>
			
		</div>                                                            
	</div>
</div>
</div>


<?php 
		
if ($anak+0 >= 1) {
	echo "<div id='div-anak-bayi' class='col-md-12'>
	<div class='col-md-6'>
	<div class='panel panel-primary'>
	<div class='panel-heading'>TRAVELER ANAK</div>
	<div class='panel-body'>";
			
	foreach ($TravelerAnak as $key => $val) {
    echo $form->field($val, "[$key]nama")->textInput()->label("$key"-count($modelTraveler)+1);}
    echo "</div></div></div>";
	} 
?>	
			
<?php
	if ($bayi+0 >= 1) {
	echo "<div id='div-bayi' class='col-md-6'>
		<div class='panel panel-primary'>
		<div class='panel-heading'>TRAVELER BAYI</div>
		<div class='panel-body'>";
				
			foreach ($Travelerbayi as $key => $val) {
			echo $form->field($val, "[$key]nama")->textInput()->label("$key"-count($modelTraveler+$TravelerAnak)+1);}
	echo "</div></div></div>";
			}
		?>
		
	
</div>

<div class="form-group col-md-12">
        <?= Html::submitButton(Yii::t('app', 'NEXT STEP'), ['class' => 'btn-lg btn-block btn-warning']) ?>
    </div>
<?php ActiveForm::end();
    ?>
</div>
