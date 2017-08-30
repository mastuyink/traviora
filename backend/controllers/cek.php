<?php 

use app\models\VValidasiPembayaran;

        $Jumlah = VValidasiPembayaran::find()->count();
        $sesi      = Yii::$app->session;
        $sesi->open();
        $sesi['validasi.jumlah'] = $Jumlah;
        $sesi->close();

?>