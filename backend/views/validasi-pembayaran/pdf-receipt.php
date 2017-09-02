
<table width="100%" cellspacing="0" cellpadding="0" border="0">
              <tbody>
              <tr>
                <td valign="top" bgcolor="#ffffff">
                <!-- Header Start  -->
                 <table style="margin-bottom:0px; margin-top:0px;" width="100%" contenteditable="false" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr valign="bottom">    
                            <td style="border-bottom:2px solid black;" width="20" valign="top" align="center"> </td>
                            <td style="border-bottom:2px solid black;" align="left">
                                <img alt="Logo" style="width: 50%;" src="<?php echo Yii::$app->basePath.'/File-Pesanan/receipt.png' ?>"  border="0">
                            </td>   
                            <td style="border-bottom:2px solid black;" valign="top" align="center"> </td>
                            <td style="border-bottom:2px solid black;" align="right">
                                    <span style="font:italic 12px; Calibri, Trebuchet, Arial, sans serif; color: #757575;line-height:15px;"> 
                                        <!-- EmailContentHeader : start -->

<span style="display:inline;">
<?= $modelBooking->waktu_booking ?>
</span>


<span style="display:inline;">
<br>
Booking ID: <strong><?= $modelBooking->id ?></strong><br><br>
</span>


                                    </span>
                            </td>
                            <td style="border-bottom:2px solid black;" width="20" valign="top" align="center"> </td>
                        </tr>
                    </tbody>
                    </table>

               <!-- Header : end -->     

<br>
<p>Together with this we confirm the payment has been received from:</p>
<br>

<!-- sender Start -->
 <table style="color:#333 !important;font-family: arial,helvetica,sans-serif;font-size:12px; margin-bottom:20px;" width="60%" contenteditable="false" cellspacing="0" cellpadding="0" border="0">
<tbody><tr style="border-bottom:2px solid #ccc;">
<td style="padding-top:5px; width: 25px;" valign="top">


<span style="display:inline; font-weight: bold;">Name 
<br>
</span>


<span style="display:inline; font-weight: bold;">Payment Method
<br>
</span>
<span style="display:inline; font-weight: bold;">
<br>
</span>

</td>
<td style="padding-top:5px;padding-left:10px;width: 25px;" valign="top">

<span style="display: inline;">
: <?= $modelBooking->tPembayaran->nama_pengirim ?>
</span><br>
  <span style="display: inline;">
: <?= $modelBooking->tPembayaran->idMetode->metode ?>
</span><br>
  <span style="display: inline;">

</span>

<!-- EmailContentBuyerNote : end -->
</td>
</tr>


</tbody>
</table>

<!--sender end-->
<table class="table-striped" style="clear:both;color:#333 !important;font-family: arial,helvetica,sans-serif;font-size:12px;margin-top:20px;" width="100%" contenteditable="false" cellspacing="0" cellpadding="0" border="0" align="center">
<tbody>
<tr>
<td style="text-align: left; border-top:2px solid black; border-bottom:2px solid black; border-right:none;border-left:none;padding:20px 10px 20px 10px;color: #333333 !important; font-weight:bold;">
Description
</td>
<td style="text-align: left;border-top:2px solid black; border-bottom:2px solid black;border-right:none;border-left:none;padding:20px 10px 20px 10px;color: #333333 !important; font-weight:bold;" width="20%">

</td>
  <td style="text-align: right;border-top:2px solid black; border-bottom:2px solid black;border-right:none;border-left:none;padding:20px 10px 20px 10px;color: #333333 !important; font-weight:bold;" width="20%">Currency</td>
<td style="text-align: right;border-top:2px solid black; border-bottom:2px solid black;border-right:none;border-left:none;padding:20px 10px 20px 10px;color: #333333 !important; font-weight:bold;" width="20%">
Unit price
</td>


</tr>

<tr style="padding: 10px;border-bottom:1px dashed #ccc;">
  <td style="text-align: left;border-top:1px solid #ccc;border-bottom:none;border-right:none;border-left:none;padding:5px 10px 5px 10px;color: #333333 !important;">
<span style=" word-break;break-all">
Trip Price
  </span>
</td>
  <td style="text-align: right;border-top:1px solid #ccc;border-bottom:none;border-right:none;border-left:none;padding:5px 10px 5px 10px;color: #333333 !important;">
<span style=" word-break;break-all">

  </span>

 </td>
 <td style="text-align: right;border-top:1px solid #ccc;border-bottom:none;border-right:none;border-left:none;padding:5px 10px 5px 10px;color: #333333 !important;">
<?= $modelBooking->tPembayaran->currency ?>
</td>
  <td style="text-align: right;border-top:1px solid #ccc;border-bottom:none;border-right:none;border-left:none;padding:5px 10px 5px 10px;color: #333333 !important;">
<?= $modelBooking->biaya_trip ?>
</td>

</tr>  
<tr style="padding: 10px;border-bottom:1px dashed #ccc;">
  <td style="text-align: left;border-top:1px solid #ccc;border-bottom:none;border-right:none;border-left:none;padding:5px 10px 5px 10px;color: #333333 !important;">
<span style=" word-break;break-all">
Pickup Cost
  </span>
</td>
  <td style="text-align: right;border-top:1px solid #ccc;border-bottom:none;border-right:none;border-left:none;padding:5px 10px 5px 10px;color: #333333 !important;">
<span style=" word-break;break-all">

  </span>

 </td>
 <td style="text-align: right;border-top:1px solid #ccc;border-bottom:none;border-right:none;border-left:none;padding:5px 10px 5px 10px;color: #333333 !important;">
<?= $modelBooking->tPembayaran->currency ?>
</td>
  <td style="text-align: right;border-top:1px solid #ccc;border-bottom:none;border-right:none;border-left:none;padding:5px 10px 5px 10px;color: #333333 !important;">
<?= $modelBooking->biaya_jemput ?>
</td>

</tr>

<tr style="padding: 10px;border-bottom:1px dashed #ccc;">
  <td style="text-align: left;border-top:1px solid #ccc;border-bottom:2px solid black;border-right:none;border-left:none;padding:5px 10px 5px 10px;color: #333333 !important;">
<span style=" word-break;break-all">
Drop Off Cost
  </span>
</td>
  <td style="text-align: right;border-top:1px solid #ccc;border-bottom:2px solid black;border-right:none;border-left:none;padding:5px 10px 5px 10px;color: #333333 !important;">
<span style=" word-break;break-all">

  </span>

 </td>
 <td style="text-align: right;border-top:1px solid #ccc;border-bottom:2px solid black;border-right:none;border-left:none;padding:5px 10px 5px 10px;color: #333333 !important;">
<?= $modelBooking->tPembayaran->currency ?>
</td>
  <td style="text-align: right;border-top:1px solid #ccc;border-bottom:2px solid black;border-right:none;border-left:none;padding:5px 10px 5px 10px;color: #333333 !important;">
<?= $modelBooking->biaya_antar ?>
</td>

</tr>


<tr style="padding: 10px;border-bottom:1px dashed #ccc;">
  <td style="text-align: left; font-weight: bold; background: #bdc3c7;  border-top:1px solid #ccc;border-bottom: none;border-right:none;border-left:none;padding:5px 10px 5px 10px;color: #333333 !important;">
<span style=" word-break;break-all">

  </span>
</td>
  <td style="text-align: left; font-weight: bold; background: #bdc3c7;  border-top:1px solid #ccc;border-bottom: none;border-right:none;border-left:none;padding:5px 10px 5px 10px;color: #333333 !important;">
<span style=" word-break;break-all">
TOTAL
  </span>

 </td>
 <td style="text-align: right; font-weight: bold; background: #bdc3c7;  border-top:1px solid #ccc;border-bottom: none;border-right:none;border-left:none;padding:5px 10px 5px 10px;color: #333333 !important;">
<?= $modelBooking->tPembayaran->currency ?>
</td>
  <td style="text-align: right; font-weight: bold; background: #bdc3c7;  border-top:1px solid #ccc;border-bottom: none;border-right:none;border-left:none;padding:5px 10px 5px 10px;color: #333333 !important;">
<?= $modelBooking->total_biaya ?>
</td>

</tr>


</tbody>
</table>

 </td>
</tr>
</tbody>
</table>
