<html><head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,width=device-width,height=device-height,target-densitydpi=device-dpi,user-scalable=no">
        <title>Traviora Supplier Reservation</title>

</head>
   <body style="padding:0; margin:0; background:#f2f2f2;">  
      

<table class="marginFix" width="100%" cellspacing="0" cellpadding="0" border="0">
  <!-- GRAY BACKGROUND -->
  <tbody><tr>
    <td class="mobMargin" style="font-size:0px;" bgcolor="#f2f2f2"> </td>
    <td class="mobContent" width="660" bgcolor="#ffffff" align="center">
      <!-- inner container / place all modules below --> 
      <table width="100%" cellspacing="0" cellpadding="0" border="0">
          <!-- BEGIN MAIN CONTENT -->
          <tbody><tr><td width="600" valign="top" align="center">
              <table width="100%" cellspacing="0" cellpadding="0" border="0">
              <tbody><tr class="no_mobile_phone">
                <td style="padding-top:10px;" bgcolor="#f2f2f2"></td>
              </tr>
              <tr>
                <td style="padding-top:10px;" bgcolor="#f2f2f2"></td>
              </tr>
              <tr>
                <td valign="top" bgcolor="#ffffff" align="center">
                  <!-- PLACE ALL MODS BELOW --> 
                  <!-- PayPal logo - start -->
                    <table style="margin-bottom:10px; margin-top:15px;" width="100%" contenteditable="false" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr valign="bottom">    
                            <td style="border-bottom:2px solid black;" width="20" valign="top" align="center"> </td>
                            <td style="border-bottom:2px solid black;" height="64" align="left">
                                <img alt="Logo" style="width:85%; height:85%;" src="http://traviora.com/traviora.png"  border="0"><br><br>
                            </td>   
                            <td style="border-bottom:2px solid black;" width="40" valign="top" align="center"> </td>
                            <td style="border-bottom:2px solid black;" align="right">
                                    <span style="padding-top:15px; padding-bottom:10px; font:italic 12px; Calibri, Trebuchet, Arial, sans serif; color: #757575;line-height:15px;"> 
                                        <!-- EmailContentHeader : start -->

<span style="display:inline;">
<?= $modelBooking->waktu_booking ?>
</span>


<span style="display:inline;">
<br>
Booking ID: <strong><?= $modelBooking->id ?></strong><br><br>
</span>

<!-- EmailContentHeader : end -->
                                    </span>
                            </td>
                            <td style="border-bottom:2px solid black;" width="20" valign="top" align="center"> </td>
                        </tr>
                    </tbody></table>
                 <!-- PayPal logo - start -->
                <!-- body - start -->
                    <table style="padding-bottom:10px; padding-top:10px;margin-bottom: 20px;" width="100%" contenteditable="false" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr valign="bottom">    
                            <td width="20" valign="top" align="center"> </td>
                            <td style="font-family:Calibri, Trebuchet, Arial, sans serif; font-size:15px; line-height:22px; color:#333333;" class="ppsans" valign="top">
                                    <p><!-- EmailGreeting : start -->
<!-- EmailGreeting : end --></p>
<div style="margin-top: 10px;color:#333 !important;font-family: arial,helvetica,sans-serif;font-size:12px;">
<center><span style="font-size:30px; font-weight:bold;text-decoration:none;">SUPPLIER RESERVATION</span>
</center>
<table contenteditable="false">
<tbody>
<tr>
<td valign="bottom">Dear Reservation team <strong><?= $modelBooking->idDestinasi->idSupplier->nama ?></strong> . <p>Through this email we intend to make a reservation that our guests have been using.</p><span style="display:inline;">

  </td>
  <td></td>
  </tr>
  </tbody>
  </table><br>
 
  <table style="color:#333 !important;font-family: arial,helvetica,sans-serif;font-size:12px; margin-bottom:20px;" width="100%" contenteditable="false" cellspacing="0" cellpadding="0" border="0">
<tbody><tr style="border-bottom:2px solid #ccc;">
<td style="padding-top:5px;" width="50%" valign="top">
<!-- EmailContentSellerBuyerDetails : start --><span style="color:#333333;font-weight:bold; font-size:20px;">Leader Contact</span><br>

<span style="display:inline;">Name 
<br>
</span>


<span style="display:inline;">Email
<br>
</span>
<span style="display:inline;">Cell Phone Number
<br>
</span>



<!-- EmailContentSellerBuyerDetails : end -->
</td>
<td style="padding-top:5px;padding-left:10px;" width="50%" valign="top">
<!-- EmailContentBuyerNote : start -->



<span style="color:#333333;"></span>
  <br>
<span style="display: inline;">
: <?= $modelCustomer->nama_customer ?>
</span><br>
  <span style="display: inline;">
: <?= $modelCustomer->email ?>
</span><br>
  <span style="display: inline;">
: <?= $modelCustomer->no_telp ?>
</span>

<!-- EmailContentBuyerNote : end -->
</td>
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
Destination
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




<table style="border-top: 1px solid #ccc;border-bottom: 1px solid #ccc;color:#333 !important;font-family: arial,helvetica,sans-serif;font-size:12px;margin-bottom:10px;" width="100%" contenteditable="false" cellspacing="0" cellpadding="0" border="0" align="center">
<tbody><tr>


<td>
<table style="width:100%; color:#333 !important;font-family: arial,helvetica,sans-serif;font-size:12px;margin-top: 10px;" contenteditable="false" cellspacing="0" cellpadding="0" border="0">

<tbody>

<tr>
<td colspan="3" style="width:100%;text-align:right; padding:10px 0 20px 0;">
<center>
<p>Please contact us immediately if there is a trip problem. you can reply this email or contact form Via link Bellow</p>
<a class="button_blue" href="http://travel.com/contact"
 style="text-decoration:none;background: #0079c1;
        font-family:HelveticaNeueLight,HelveticaNeue-Light,Helvetica Neue Light,HelveticaNeue,Helvetica,Arial,sans-serif;
        font-weight:300;
        font-stretch:normal;
        text-align:center;
        color:#fff;
        font-size:15px;
        /*button styles*/
        border-radius:7px !important;
        -webkit-border-radius: 7px !important;
        -moz-border-radius: 7px !important;
        -o-border-radius: 7px !important;
        -ms-border-radius: 7px !important;
        /*styles from button.jsp */ line-height: 1.45em; padding: 7px 15px 8px; font-size: 1em;
         padding-bottom: 7px; margin: 0 auto 16px;">Confirmation</a>
</center>
</td>
</tr>
</tbody></table>
</td>
</tr>

</tbody></table>
<!-- EmailContentPayeeTransaction : end -->
Questions? Contact Us at <strong>reservation@Traviora.com</strong><br><br>

 <li>Perum Permata Ariza Blok O/2 Mekarsari, Jimbaran. Bali - Indonesia.</li>
 <li>+62-813-5330-4990</li>
 <li><a id="button_text" style="text-decoration: none; font-size: 110%" class="applefix" href="traviora.com">https://Traviora.com</li></a>
 <br></div><p></p>
                                <span style="font-weight:bold; color:#444;">
                                </span>
                                <span>
                                </span>
                            </td>
                            <td width="20" valign="top" align="center"> </td>
                        </tr>
                    </tbody></table>
                <!-- body - end -->
                  <!-- PLACE ALL MODS ABOVE -->
                </td>
              </tr>
            </tbody></table></td>
          <!-- END MAIN CONTENT -->           
       </tr></tbody></table>
      <!-- end inner container / place all modules above -->
      <!--  footer modules -->
      <table width="100%" cellspacing="0" cellpadding="0" border="0">
          <!-- BEGIN FOOOTER CONTENT -->
          <tbody><tr><td width="600" valign="top" align="center">
              <table width="100%" cellspacing="0" cellpadding="0" border="0">
              <tbody><tr>
                  <td style="padding-top:20px;" bgcolor="#f2f2f2"></td>
              </tr>
              <tr>
                <td valign="top" bgcolor="#f2f2f2" align="center">
                  <!-- PLACE ALL MODS BELOW --> 
                   <table width="100%" contenteditable="false" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr valign="bottom">   
                            <td>
                                <!--  footer links -->   
                                <table class="mobile_table_width_utility_nav" cellspacing="0" cellpadding="0" border="0" align="left">
                                   <tbody>
                                      <tr>
                                         <td class="ultility_nav_padding" style="font-family:Calibri, Trebuchet, Arial, sans serif; -webkit-font-smoothing: antialiased; font-size:13px; color:#666; font-weight:bold;">
                                            <span id="bottomLinks">
                                            </span>
                                         </td>
                                      </tr>
                                   </tbody>
                                </table>
                           </td>
                           <td width="20" valign="top" align="center"> </td>    
                        </tr>
                    </tbody></table>           
                     <table width="100%" contenteditable="false" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr valign="bottom">   
                            <td width="20" valign="top" align="center"> </td>
                            <td>
                                <span style="font-family:Calibri, Trebuchet, Arial, sans serif; font-size:13px; !important color:#8c8c8c;">  
                                    <!--  tracking -->
                                    <table id="emailFooter" style="padding-top:20px;font:12px Arial, Verdana, Helvetica, sans-serif;color:#292929;" width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td>
                                    <p>Copyright © 2017 Traviora.com. All rights reserved.</p>
                                   </td></tr></tbody></table>

                                </span>
                           </td>
                           <td width="20" valign="top" align="center"> </td>    
                        </tr>
                    </tbody></table>    
                  <!-- PLACE ALL MODS ABOVE -->
                </td>
              </tr>
            </tbody></table></td>
          <!-- END MAIN CONTENT -->           
       </tr></tbody></table>
    </td>
    <td class="mobMargin" style="font-size:0px;" bgcolor="#f2f2f2"> </td>
  </tr>
  <!-- END GRAY BACKGROUND -->
</tbody></table>
<!-- END CONTAINER -->

   
</body></html>