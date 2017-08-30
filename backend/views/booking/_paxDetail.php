<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TBooking */
/* @var $form yii\widgets\ActiveForm */
?>

<?php 
		$dew = $session['traveler.nama_traveler'];

	echo "<div class='col-md-12'>
	<div class='panel panel-primary'>
	<div class='panel-heading'>TRAVELER DEWASA</div>
	<div class='panel-body'>";
	
	foreach ($TravelerDewasa as $key => $val) {
    echo $form->field($val, "[$key]nama")->textInput(['class'=>'edited form-control','value'=>$dew[$key]])->label($val->nama);
}
    echo "</div></div></div>";
	
?>	

<?php 
	$ank = $session['traveler.nama_anak'];
		
if ($anak+0 >= 1) {
		
	echo "
	<div class='col-md-12'>
	<div class='panel panel-primary'>
	<div class='panel-heading'>TRAVELER ANAK</div>
	<div class='panel-body'>";
		$x = 0;	
	foreach ($TravelerAnak as $key => $val) {
    echo $form->field($val, "[$key]nama")->textInput(['class'=>'edited form-control','value'=>$ank[$x]])->label($val->nama);
    $x = $x+1;
}
    echo "</div></div></div>";
	} 
?>	
			
<?php
	if ($bayi+0 >= 1) {
	echo "<div id='div-bayi' class='col-md-12'>
		<div class='panel panel-primary'>
		<div class='panel-heading'>TRAVELER BAYI</div>
		<div class='panel-body'>";
				$bay = $session['traveler.nama_bayi'];
				$x = 0;	

			foreach ($Travelerbayi as $key => $val) {
			echo $form->field($val, "[$key]nama")->textInput(['class'=>'edited form-control','value'=>$bay[$x]])->label($val->nama);
			$x = $x+1;
		}
	echo "</div></div></div>";
			}
		?>