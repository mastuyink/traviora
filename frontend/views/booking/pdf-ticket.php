<?php
use yii\helpers\Html;

include Yii::$app->basePath."/phpqrcode/qrlib.php"; //<-- LOKASI FILE UTAMA PLUGINNYA
$tempdir = Yii::$app->basePath."/File-Pesanan/".$modelBooking->id."/"; //<-- Nama Folder file QR Code kita nantinya akan disimpan
if (!file_exists($tempdir))#kalau folder belum ada, maka buat.
    mkdir($tempdir);
#parameter inputan
$isi_teks = "http://traviora.com/";
$namafile = "QrCode.png";
$quality = 'L'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
$ukuran = 4; //batasan 1 paling kecil, 10 paling besar
$padding = 1;
QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);

?>
<html><head></head><body><table width="100%" cellspacing="0" cellpadding="0" border="0">
              <tbody>
              
              <tr>
                <td valign="top" bgcolor="#ffffff" align="center">
                  <!-- PLACE ALL MODS BELOW --> 
                  <!-- PayPal logo - start -->
                    <table style="margin-bottom:10px;" width="100%" contenteditable="false" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                        <tr valign="center">    
                            <td width="20" valign="top" align="center"> </td>
                            <td height="64" align="left">
                                <img alt="banner" style="width:47%; height:15%;" src="<?php echo Yii::$app->basePath.'/File-Pesanan/text.png' ?>" border="0"><br><br>
                                
                            </td>   

                            <td width="40" valign="top" align="center"> 

                            </td>

<td style=" padding-bottom:10px;" align="center">
 <img src="<?php echo Yii::$app->basePath."/File-Pesanan/".$modelBooking->id."/QrCode.png" ?>" />
</td>


 <td width="20" valign="top" align="center"> </td>
</tr>
<tr valign="center">
  <td style="border-bottom:2px solid black;" > </td>
  <td style="border-bottom:2px solid black;"></td>
  <td style="border-bottom:2px solid black;"></td>
  
   <td style="border-bottom:2px solid black;" align="center"><strong style="font-size:25px; color: #0091EA;"><?= $modelBooking->id ?></strong></td>
   <td style="border-bottom:2px solid black;"></td>
</tr>
</tbody>
</table>

<!-- Trip Description start-->
<table style="clear:both;color:#333 !important;font-family: arial,helvetica,sans-serif;font-size:12px;margin-top:20px;" width="100%" contenteditable="false" cellspacing="0" cellpadding="0" border="0" align="center">
<tbody>

<tr>


  <td style="background-color: #ccc; border-top:2px solid #ccc; border-bottom:2px solid #ccc;border-right:none;border-left:none;padding-top:10px;padding-right: 5px; padding-bottom: 10px; padding-left: 15px;color: #333333 !important; font-weight:bold; font-size: 18px;">
Trip Description
</td>
<td style="text-align: right;border-top: none; border-bottom:2px solid #ccc;border-right:none;border-left:none;color: #333333 !important;">

</td>


</tr>


<tr>
<td style="text-align: left;border-top:none; border-bottom:1px solid #ccc;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 10px;color: #333333 !important; " width="30%">
Name Of Trip
</td>
  <td style="text-align: left;border-top:none; border-bottom:1px solid #ccc;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 5px;color: #333333 !important;">: <?= $modelBooking->idDestinasi->nama_destinasi ?>
</td>
</tr>

<tr>
<td style="text-align: left;border-top:none; border-bottom:1px solid #ccc;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 10px;color: #333333 !important; " width="30%">
Date Of Trip
</td>
  <td style="text-align: left;border-top:none; border-bottom:1px solid #ccc;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 5px;color: #333333 !important; font-weight: bold;">: <?php echo date('d-m-Y',strtotime($modelBooking->tgl_trip)) ?>
</td>
</tr>

<tr>
<td style="text-align: left;border-top:none; border-bottom:1px solid #ccc;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 10px;color: #333333 !important; " width="30%">
Total Pax
</td>
  <td style="text-align: left;border-top:none; border-bottom:1px solid #ccc;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 5px;color: #333333 !important;">: <?= $modelBooking->total_pax." Pax" ?> 
</td>
</tr>

</tbody>
</table>
<!-- Trip Description End-->


<!-- Pickup  Start -->

<?php if($modelJemput != null || $modelAntar != null): ?>
<table style="clear:both;color:#333 !important;font-family: arial,helvetica,sans-serif;font-size:12px;margin-top:20px;" width="100%" contenteditable="false" cellspacing="0" cellpadding="0" border="0" align="center">
<tbody>

<tr>
<td style="background-color: #ccc;text-align: left;border-top: none; border-bottom:2px solid #6C7A89;border-right:none;border-left:none;color: #333333 !important; padding-top:10px;padding-right: 5px; padding-bottom: 10px; padding-left: 15px; font-weight:bold; font-size: 15px;">

</td>

  <td style="background-color: #F2F1EF; border-top:2px solid #F2F1EF; border-bottom:2px solid #6C7A89;border-right:none;border-left:none;padding-top:10px;padding-right: 5px; padding-bottom: 10px; padding-left: 15px;color: #333333 !important; font-weight:bold; font-size: 14px;">
Pickup
</td>

<td style="background-color: #ECF0F1; border-top:2px solid #ECF0F1; border-bottom:2px solid #6C7A89;border-right:none;border-left:none;padding-top:10px;padding-right: 5px; padding-bottom: 10px; padding-left: 15px;color: #333333 !important; font-weight:bold; font-size: 14px;">
Drop Off
</td>
</tr>


<tr>
<td style="text-align: left;border-top:none; border-bottom:1px solid #6C7A89;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 10px;color: #333333 !important; font-weight:bold;" width="30%">
Area
</td>
 
  <td style="background-color: #F2F1EF;text-align: left;border-top:none; border-bottom:1px solid #6C7A89;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 0px;color: #333333 !important;">: <?= $modelJemput == null ?  "No Pickup" :  $modelJemput->idAreaJemput->idLokasiAj->lokasi_aj ;?>
</td>

<td style="background-color: #ECF0F1;text-align: left;border-top:none; border-bottom:1px solid #6C7A89;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 5px;color: #333333 !important;">: <?= $modelAntar == null ?  "No Drop Off" :  $modelAntar->idAreaAntar->idLokasiAj->lokasi_aj ;?>
</td>
</tr>

<tr>
<td style="text-align: left;border-top:none; border-bottom:1px solid #6C7A89;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 10px;color: #333333 !important; font-weight:bold;" width="30%">
Location/Hotel 
</td>
  <td style="background-color: #F2F1EF;text-align: left;border-top:none; border-bottom:1px solid #6C7A89;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 0px;color: #333333 !important;">: <?= $modelJemput == null ?  "-" :  $modelJemput->idAreaJemput->nama_area ;?>
</td>
<td style="background-color: #ECF0F1;text-align: left;border-top:none; border-bottom:1px solid #6C7A89;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 5px;color: #333333 !important;">:  <?php if ($modelAntar == null && $modelAntar->id_area_antar == null) {
    echo "-";
  }elseif ($modelAntar != null && $modelAntar->id_area_antar == null) {
    echo "Will be notified later";
  }elseif ($modelAntar != null && $modelAntar->id_area_antar != null) {
    echo $modelAntar->idAreaAntar->nama_area;
  }else{
    echo"nothing";
    } ?>

</td>
</tr>

<tr>
<td style="text-align: left;border-top:none; border-bottom:1px solid #6C7A89;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 10px;color: #333333 !important; font-weight:bold;" width="30%">
Location/Hotel Detail
</td>
  <td style="background-color: #F2F1EF;text-align: left;border-top:none; border-bottom:1px solid #6C7A89;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 0px;color: #333333 !important;">: <?= $modelJemput == null ?  "-" :  $modelJemput->alamat_jemput ;?>
</td>
<td style="background-color: #ECF0F1;text-align: left;border-top:none; border-bottom:1px solid #6C7A89;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 5px;color: #333333 !important;">: <?= $modelAntar == null ?  "-" :  $modelAntar->alamat_antar ;?>
</td>
</tr>
<tr>
<td style="text-align: left;border-top:none; border-bottom:1px solid #6C7A89;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 10px;color: #333333 !important; font-weight:bold;" width="30%">
Phone
</td>
  <td style="background-color: #F2F1EF;text-align: left;border-top:none; border-bottom:1px solid #6C7A89;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 0px;color: #333333 !important;">: <?= $modelJemput == null ?  "-" :  $modelJemput->no_telp_jemput ;?>
</td>
<td style="background-color: #ECF0F1;text-align: left;border-top:none; border-bottom:1px solid #6C7A89;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 5px;color: #333333 !important;">: <?= $modelAntar == null ?  "-" :  $modelAntar->no_telp_antar ;?>
</td>
</tr>
<tr>
<td style="text-align: left;border-top:none; border-bottom:1px solid #6C7A89;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 10px;color: #333333 !important; font-weight:bold;" width="30%">
Transport Type
</td>
  <td style="background-color: #F2F1EF;text-align: left;border-top:none; border-bottom:1px solid #6C7A89;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 0px;color: #333333 !important;">: <?php if ($modelJemput == null && $modelJemput->id_metode_jemput == null) {
    echo "-";
  }elseif ($modelJemput != null && $modelJemput->id_metode_jemput == null) {
    echo "Will be notified later";
  }elseif ($modelJemput != null && $modelJemput->id_metode_jemput != null) {
    echo $modelJemput->idMetodeJemput->jenis_tarif;
  }else{
    echo"nothing";
    } ?>
</td>
<td style="background-color: #ECF0F1;text-align: left;border-top:none; border-bottom:1px solid #6C7A89;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 5px;color: #333333 !important;">: <?php if ($modelAntar == null && $modelAntar->id_metode_antar == null) {
    echo "-";
  }elseif ($modelAntar != null && $modelAntar->id_metode_antar == null) {
    echo "Will be notified later";
  }elseif ($modelAntar != null && $modelAntar->id_metode_antar != null) {
    echo $modelAntar->idMetodeAntar->jenis_tarif;
  }else{
    echo"nothing";
    } ?>
</td>
</tr>
<tr>
<td style="text-align: left;border-top:none; border-bottom:1px solid #6C7A89;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 10px;color: #333333 !important; font-weight:bold; " width="30%">
Pickup Time
</td>
  <td style="background-color: #F2F1EF;text-align: left;border-top:none; border-bottom:1px solid #6C7A89;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 0px;color: #333333 !important; font-weight: bold;">: <?php if ($modelJemput == null && $modelJemput->id_jam_jemput == null) {
    echo "-";
  }elseif ($modelJemput != null && $modelJemput->id_jam_jemput == null) {
    echo "Will be notified later";
  }elseif ($modelJemput != null && $modelJemput->id_jam_jemput != null) {
    echo date('G:i',strtotime($modelJemput->idJamJemput->end_time))." WITA ";
  }else{
    echo"nothing";
    } ?>
</td>
<td style="text-align: left;border-top:none; border-bottom:1px solid #6C7A89;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 5px;color: #333333 !important;">
</td>
</tr>

</tbody>
</table>
<?php endif; ?>
<!-- Pickup  End -->


<!-- Adult Start -->
<table style="clear:both;color:#333 !important;font-family: arial,helvetica,sans-serif;font-size:12px;margin-top:20px;" width="100%" contenteditable="false" cellspacing="0" cellpadding="0" border="0" align="center">
<tbody>
<tr>
  <td style="background-color: #81D4FA; border-top:2px solid #81D4FA; border-bottom:2px solid #81D4FA;border-right:none;border-left:none;padding-top:10px;padding-right: 5px; padding-bottom: 10px; padding-left: 5px;color: #333333 !important; font-weight:bold; font-size: 14px;">
Adult Pax
</td>
<td style="text-align: right;border-top: none; border-bottom:2px solid #ccc;border-right:none;border-left:none;color: #333333 !important;">
</td>
</tr>
<?php foreach ($TravelerDewasa as $key => $value): ?>
<tr>
<td style="text-align: left;border-top:none; border-bottom:1px solid #ccc;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 10px;color: #333333 !important; " width="30%">
Name Adult <?= $key+1 ?>
</td>
  <td style="text-align: left;border-top:none; border-bottom:1px solid #ccc;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 5px;color: #333333 !important;">: <?= $value->nama ?>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<!-- Adult End -->

<!-- Children Start -->
<?php if (!empty($TravelerAnak)):?>
<table style="clear:both;color:#333 !important;font-family: arial,helvetica,sans-serif;font-size:12px;margin-top:20px;" width="100%" contenteditable="false" cellspacing="0" cellpadding="0" border="0" align="center">
<tbody>
<tr>
  <td style="background-color: #81D4FA; border-top:2px solid #81D4FA; border-bottom:2px solid #81D4FA;border-right:none;border-left:none;padding-top:10px;padding-right: 5px; padding-bottom: 10px; padding-left: 5px;color: #333333 !important; font-weight:bold; font-size: 14px;">
Children Pax
</td>
<td style="text-align: right;border-top: none; border-bottom:2px solid #ccc;border-right:none;border-left:none;color: #333333 !important;">
</td>
</tr>
<?php foreach ($TravelerAnak as $key => $value): ?>
<tr>
<td style="text-align: left;border-top:none; border-bottom:1px solid #ccc;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 10px;color: #333333 !important; " width="30%">
Name Children <?= $key+1 ?>
</td>
  <td style="text-align: left;border-top:none; border-bottom:1px solid #ccc;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 5px;color: #333333 !important;">: <?= $value->nama ?>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php endif; ?>
<!-- Children End -->

<!-- Infant Start -->
<?php if (!empty($TravelerBayi)):?>
<table style="clear:both;color:#333 !important;font-family: arial,helvetica,sans-serif;font-size:12px;margin-top:20px;" width="100%" contenteditable="false" cellspacing="0" cellpadding="0" border="0" align="center">
<tbody>
<tr>
  <td style="background-color: #81D4FA; border-top:2px solid #81D4FA; border-bottom:2px solid #81D4FA;border-right:none;border-left:none;padding-top:10px;padding-right: 5px; padding-bottom: 10px; padding-left: 5px;color: #333333 !important; font-weight:bold; font-size: 14px;">
Infant Pax
</td>
<td style="text-align: right;border-top: none; border-bottom:2px solid #ccc;border-right:none;border-left:none;color: #333333 !important;">
</td>
</tr>

<?php foreach ($TravelerBayi as $key => $value): ?>
<tr>
<td style="text-align: left;border-top:none; border-bottom:1px solid #ccc;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 10px;color: #333333 !important; " width="30%">
Name Infant <?= $key+1 ?>
</td>
  <td style="text-align: left;border-top:none; border-bottom:1px solid #ccc;border-right:none;border-left:none;padding-top:5px;padding-right: 0px; padding-bottom: 5px; padding-left: 5px;color: #333333 !important;">: <?= $value->nama ?>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php endif; ?>
<!-- Infant End -->



 </td>
</tr>
</tbody>
</table>
</body>
</html>