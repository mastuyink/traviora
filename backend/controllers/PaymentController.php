<?php

namespace backend\controllers;

use Yii;
use app\models\TPembayaran;
use app\models\ConfirmPayment;
use app\models\TBooking;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TTransportController implements the CRUD actions for TTransport model.
 */
class PaymentController extends Controller
{
   
    public function actionConfirmPayment($token)
    {
        // $this->layout = 'no-tab';
        $modelPembayaran = $this->findToken($token);
                

                if ($modelPembayaran->load(Yii::$app->request->post()) && $modelPembayaran->validate()) {
                $modelBooking = TBooking::findOne($modelPembayaran->id_booking);
                $modelBooking->id_status = '2';
                $modelBooking->validate();
                $modelBooking->save();
                $modelPembayaran->save();
                return $this->redirect('/post/home');
                } else {
                return $this->render('confirm-payment', [
                'modelPembayaran' => $modelPembayaran,
                ]);
                }
     
    }

    protected function findToken($token)
    {
        $dec = Yii::$app->getSecurity()->unmaskToken($token);
        if (($modelPembayaran = ConfirmPayment::find()->where(['token_konfirmasi'=>$dec])->one()) !== null && ($modelBooking = TBooking::find()->where(['id'=>$modelPembayaran->id_booking])->andWhere(['id_status'=> 1])->one()) !== null) {
         
                return $modelPembayaran;
            
           
        } else {
            throw new NotFoundHttpException('Mohon Maaf Token Tidak Ditemukan / Pesanan Sudah Expired Silahkan Hubungi Kami jika Ada Kesalahan.... Terimakasih');
        }
    }

   
    
}
