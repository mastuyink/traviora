<?php

namespace backend\controllers;

use Yii;
use app\models\VValidasiPembayaran;
use app\models\TBooking;
use app\models\TCustomer;
use app\models\TTraveler;
use app\models\CariData;
use app\models\TAntar;
use app\models\TJemput;
use app\models\TDestinasi;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use kartik\mpdf\Pdf;
use yii\helpers\FileHelper;
use dosamigos\qrcode\formats\MailTo;
use dosamigos\qrcode\QrCode;
/**
 * VValidasiPembayaranController implements the CRUD actions for VValidasiPembayaran model.
 */
class ValidasiPembayaranController extends Controller
{
    /**
     * @inheritdoc
     */
   

    /**
     * Lists all VValidasiPembayaran models.
     * @return mixed
     */
    public function actionIndex()
    {
        
            $searchModel = new CariData();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
           // $Jumlah = VValidasiPembayaran::find()->count();
            $pencarian = ArrayHelper::map(VValidasiPembayaran::find()->all(), 'id', 'id');
            $pengirim = ArrayHelper::map(VValidasiPembayaran::find()->all(), 'nama_pengirim', 'nama_pengirim');
            //$sesi      = Yii::$app->session;
            //$sesi->open();
            //$sesi['validasi.jumlah'] = $Jumlah;
            //$sesi->close();
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pencarian'=>$pencarian,
            'pengirim'=>$pengirim,
            
        ]);
    }



    public function actionValid()
    {
        if (Yii::$app->request->isAjax) {
        $data      = Yii::$app->request->post();
        $token = $data['nomor'];
        $this->findBook($token,$data);
        

       }
    }



protected function findBook($token,$data)
    {
    if (($modelBooking = TBooking::find()->where(['id'=>$token])->one()) !== null) {
        try {
                 
           //  $modelBooking->load($data);
             $modelBooking->id_status = '3';
             $modelCustomer           = TCustomer::findOne($modelBooking->id_customer);
            // $modelTraveler           = TTraveler::find()->where(['id_leader'=>$modelCustomer]);
            $TravelerDewasa          = TTraveler::find()->where(['id_leader'=>$modelCustomer])->andWhere(['id_jenis_anggota'=>1])->all();
            $TravelerAnak            = TTraveler::find()->where(['id_leader'=>$modelCustomer])->andWhere(['id_jenis_anggota'=>2])->all();
            $TravelerBayi            = TTraveler::find()->where(['id_leader'=>$modelCustomer])->andWhere(['id_jenis_anggota'=>3])->all();
            
            $modelJemput = TJemput::findOne(['id_booking'=>$modelBooking->id]);
            $modelAntar = TAntar::findOne(['id_booking'=>$modelBooking->id]);
            

             $saveTiket = Yii::$app->basePath."/File-Pesanan/".$modelBooking->id."/";
             FileHelper::createDirectory ( $saveTiket, $mode = 0777, $recursive = true );
        $pdf = new Pdf([
        // set to use core fonts only
        //'mode' => Pdf::MODE_CORE,

        'filename'=>$saveTiket.'E-Tiket.pdf',
        // A4 paper format
        'format' => Pdf::FORMAT_A4, 
        // portrait orientation
        'orientation' => Pdf::ORIENT_PORTRAIT, 
        // simpan file
        //'destination' => Pdf::DEST_BROWSER,
        'destination' => Pdf::DEST_FILE, 

        //'tempPath'=>$path,
        //'path'=>$saveTiket,

        // your html content input
        'content' => "
            ".$this->renderAjax('pdf-ticket',[
                'modelBooking'=>$modelBooking,
                'modelCustomer'=>$modelCustomer,
                'TravelerDewasa'=>$TravelerDewasa,
                'TravelerAnak'=>$TravelerAnak,
                'TravelerBayi'=>$TravelerBayi,
                'modelJemput'=>$modelJemput,
                'modelAntar'=>$modelAntar
                ])." ",  
                        // format content from your own css file if needed or use the
                        // enhanced bootstrap css built by Krajee for mPDF formatting 
                       // 'cssFile'   => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
                        // any css to be embedded if required
                        'cssInline' => '.kv-heading-1{font-size:18px}', 
                        //set mPDF properties on the fly
                        'options'   => ['title' => 'E-tiket Traviora'],
                        // call mPDF methods on the fly
                        'methods'   => [ 
                        'SetHeader' =>['E-tiket Traviora'], 
                        'SetFooter' =>['Please take this tiket on your trip departure as a justification'],
                ]
            ]); $pdf->render();

        $Receipt = new Pdf([
        'filename'=>$saveTiket.'Receipt.pdf',
        'format' => Pdf::FORMAT_A4, 
        'orientation' => Pdf::ORIENT_PORTRAIT,
        'destination' => Pdf::DEST_FILE, 
        'content' => "
            ".$this->renderAjax('pdf-receipt',[
                'modelBooking'=>$modelBooking,
                'modelCustomer'=>$modelCustomer,
                'TravelerDewasa'=>$TravelerDewasa,
                'TravelerAnak'=>$TravelerAnak,
                'TravelerBayi'=>$TravelerBayi,
                'modelJemput'=>$modelJemput,
                'modelAntar'=>$modelAntar
                ])." ",
        'cssInline' => '.kv-heading-1{font-size:18px}',
        'options'   => ['title' => 'Payment Receipt Traviora'],
        'methods'   => [ 
            'SetHeader' =>['Payment Receipt Traviora'], 
            'SetFooter' =>['This Receipt generated by system and dont require a signature'],
                ]
            ]); $Receipt->render();

             //to guest
       // $file = ;
           Yii::$app->mailReservation->compose()->setFrom('reservation@traviora.com')
            ->setTo($modelBooking->idCustomer->email)
            ->setSubject('E-TIKET TRAVIORA')
            ->setHtmlBody($this->renderAjax('email-ticket',['modelBooking'=>$modelBooking]))
            ->attach($saveTiket."E-Tiket.pdf")
            ->attach($saveTiket."Receipt.pdf")
            ->send();

            //to supplier
            $message = 'Reservation Email';
            Yii::$app->mailReservation->compose()->setFrom('reservation@traviora.com')
            ->setTo($modelBooking->idDestinasi->idSupplier->email)
            ->setSubject('Reservation Supplier Traviora')
            ->setHtmlBody($this->renderAjax('email-supplier',[
                'modelBooking'   =>$modelBooking,
                'modelCustomer'  =>$modelCustomer,
                'TravelerDewasa' =>$TravelerDewasa,
                'TravelerAnak'   =>$TravelerAnak,
                'TravelerBayi'   =>$TravelerBayi,
                'modelJemput'    =>$modelJemput,
                'modelAntar'     =>$modelAntar,
                'message'       =>$message
                ]))
            ->send();


          // $modelBooking->save();
         //  FileHelper::removeDirectory($saveTiket);
           $modelDestinasi = $this->findDestinasi($modelBooking->id_destinasi);
           $modelDestinasi->seat_terjual = $modelDestinasi->seat_terjual + count($TravelerAnak) + count($TravelerDewasa);
           $modelDestinasi->save();
            
            Yii::$app->getSession()->setFlash(
                                            'success','Validation Success. Ticket Send To Guest' );
                        Yii::$app->getSession()->setFlash(
                                            'error','Reservation Success. Email Sent To Supplier' );
    } catch (Exception $e) {
                Yii::$app->getSession()->setFlash(
                                            'error','validation. Sending Tickets And Reservation Error. Please Try Again Later' );
            }
        } else {
            throw new NotFoundHttpException('Data Kosong');
        }
    }


    /**
     * Displays a single VValidasiPembayaran model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new VValidasiPembayaran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         //$this->layout = 'no-tab';
        $model = new VValidasiPembayaran();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing VValidasiPembayaran model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
         //$this->layout = 'no-tab';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    protected function findDestinasi($id)
    {
        if (($model = TDestinasi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
 
    /**
     * Finds the VValidasiPembayaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VValidasiPembayaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VValidasiPembayaran::find()->where(['id'=>$id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
