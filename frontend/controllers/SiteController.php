<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use app\models\TPost;
use app\models\TCarrousel;
use app\models\TMainCarrousel;
use app\models\TBiayaKhusus;
use app\models\TSesiBiaya;
use app\models\LokasiDestinasi;
use app\models\TJenisDestinasi;
use app\models\TKurs;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use kartik\widgets\Growl;
use yii\data\Pagination;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        Yii::$app->view->params['listCurrency']   = ArrayHelper::map(TKurs::find()->all(), 'id', 'id');
      //  Yii::$app->view->params['Carrousel']      = TCarrousel::find()->groupBy('id_post')->all();
        Yii::$app->view->params['listLokasi']     = ArrayHelper::map(LokasiDestinasi::find()->all(), 'id', 'lokasi');
        Yii::$app->view->params['jenidDestinasi'] = ArrayHelper::map(TJenisDestinasi::find()->all(), 'id', 'jenis_destinasi');
        $model                                    = TMainCarrousel::find()->all();
        Yii::$app->view->params['carrousel']      = $model ;
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','contact'],
                'rules' => [
                   /* [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],*/
                    [
                        'actions' => ['contact'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','contact'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionTimeout(){
      $session =Yii::$app->session;
      $session->open();
       Yii::$app->getSession()->setFlash('success','Your session has TimeOut. Please re-order your trip again' );
      return $this->redirect('/');
    }

    public function actionMainCarrousel($id)
    {
        $model = $this->findCar($id);
        $response = Yii::$app->getResponse();
        return $response->sendFile($model->path, 'Carrousel', [
              //  'mimeType' => $model->type,
               // 'fileSize' => $model->size,
                'inline' => true
        ]);
    }

    protected function findCar($id){
       if (($model = TMainCarrousel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Carrousel kosong');
        }
    }


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    protected function lowerCost($Dest){
        $today = date('Y-m-d');

        $costKhusus = TBiayaKhusus::find()->where(['id_destinasi'=>$Dest])->andWhere(['tgl_event'=>$today])->one();
        $costSeason = TSesiBiaya::find()->where(['id_destinasi'=>$Dest])->andWhere(['id_jenis_sesi'=>1])->one();

        
       if ($costKhusus !== null && $costKhusus->idBiaya->biaya_dewasa < $costSeason->idBiaya->biaya_dewasa) {
            return $costKhusus->idBiaya->biaya_dewasa;
       }elseif ($costSeason !== null) {
           return $costSeason->idBiaya->biaya_dewasa;
       }else{
        return "0";
       }
    }

    protected function pencarian($lokasi, $jenisD, $sort){

         if ($lokasi == null && $jenisD == null) {
            return $dataProvider = TPost::find()->joinWith('idDestinasi')->where(['t_destinasi.id_status'=>1])->orderBy(['id'=>$sort]);
            
        }elseif ($lokasi !== null && $jenisD == null && ($dataProvider = TPost::find()->joinWith('idDestinasi')->where('t_destinasi.id_lokasi_destinasi = :lokasi',[':lokasi'=>$lokasi])->andWhere(['t_destinasi.id_status'=>1])->orderBy(['id'=>$sort])) !== null) {

          return $dataProvider;
            
        }elseif ($lokasi == null && $jenisD !== null && ($dataProvider = TPost::find()->joinWith('idDestinasi')->where('t_destinasi.id_jenis_destinasi = :jenisD',[':jenisD'=>$jenisD])->andWhere(['t_destinasi.id_status'=>1])->orderBy(['id'=>$sort])) !== null) {

            return $dataProvider;

        }elseif ($lokasi !== null && $jenisD !== null && ($dataProvider = TPost::find()->joinWith('idDestinasi')->where('t_destinasi.id_lokasi_destinasi = :lokasi',[':lokasi'=>$lokasi])->andWhere('t_destinasi.id_jenis_destinasi = :jenisD',[':jenisD'=>$jenisD])->andWhere(['t_destinasi.id_status'=>1])->orderBy(['id'=>$sort])) !== null) {
            
           return $dataProvider;

        }else{
            return null;
          
        }
    }
    /**
     * Displays homepage.
     *
     * @return mixed
     */

protected function findByLokasi($lokasi)
{   
    $model = TPost::find()->joinWith('idDestinasi.idLokasiDestinasi')->where('t_lokasi_destinasi.lokasi = :lokasi',[':lokasi'=>$lokasi]);
        return $model;

}

 protected function findByKategori($lokasi,$kategori)
{   
    $model = TPost::find()->joinWith('idDestinasi.idLokasiDestinasi')->joinWith('idDestinasi.idJenisDestinasi')->where('t_lokasi_destinasi.lokasi = :lokasi',[':lokasi'=>$lokasi])->andWhere('t_jenis_destinasi.jenis_destinasi = :kategori',[':kategori'=>$kategori]);
        return $model;
   
}

public function actionViewLokasi($lokasi = null){

  if (Yii::$app->request->isAjax) {
        $data = Yii::$app->request->post();
        $sort = $data['val'];
        $lokasi = $data['vlok'];
        $jenisD = $data['vjds'];
        $cur = $data['curx'];

        if ($sort == 1) {
            $sort = SORT_ASC;
        }elseif ($sort == 2) {
            $sort = SORT_DESC;
        }else{
            $sort = SORT_ASC;
        }

        if ($cur !== 'USD') {

            $kurs =  $this->kursTable($cur);
            $session['currency'] = $cur;

        }else{
            $kurs =  $this->kursTable();
            $session['currency'] = 'USD';
        }

       $dataProviders = $this->pencarian($lokasi, $jenisD, $sort);

    }else{
        $dataProviders = $this->findByLokasi($lokasi);
        $kurs =  $this->kursTable();
        $session['currency'] = 'USD';
    }    
        $countQuery = clone $dataProviders;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'defaultPageSize' => 6]);
        $dataProvider = $dataProviders->offset($pages->offset)->limit($pages->limit)->all();
        
    if ($dataProvider == null) {
      return $this->render('view-lokasi',[
        'dataProvider'=>$dataProvider,
        ]);
    }

        
    foreach ($dataProvider as $key => $value) {
            $lowerCost[$key] = $this->lowerCost($value->id_destinasi);
    }

    return $this->render('view-lokasi',[
        'dataProvider'=>$dataProvider,
        'kurs'=>$kurs,
        'lowerCost'=>$lowerCost,
        'pages' => $pages,
        ]);
}

public function actionViewKategori($lokasi,$kategori){


    $dataProvider = $this->findByKategori($lokasi,$kategori);
    if ($dataProvider == null) {
      return $this->render('index',[
        'dataProvider'=>$dataProvider,
        ]);
    }
    $kurs =  $this->kursTable();
    foreach ($dataProvider as $key => $value) {
            $lowerCost[$key] = $this->lowerCost($value->id_destinasi);
    }

    return $this->render('index',[
        'dataProvider'=>$dataProvider,
        'kurs'=>$kurs,
        'lowerCost'=>$lowerCost,
        ]);
}




public function actionIndex()
 {    
      
      $session =Yii::$app->session;
      $session->open();
     if ($session['alert'] == true) {
       $session      = session_unset();
            echo Growl::widget([
              'type' => Growl::TYPE_DANGER,
              'title' => 'Sorry!',
              'icon' => 'glyphicon glyphicon-remove-sign',
              'body' => 'Your session has TimeOut. Please re-order your trip again',
              'showSeparator' => true,
              'delay' => 500,
              'pluginOptions' => [
              'showProgressbar' => true,
              'placement' => [
              'from' => 'top',
              'align' => 'center',
              ]
              ]
            ]);
     }elseif ($session['timeout'] == 'sukses') {
        $session      = session_unset();
            echo Growl::widget([
              'type' => Growl::TYPE_MINIMALIST,
              'title' => 'Thank You!',
              'icon' => 'glyphicon glyphicon-check',
              'body' => 'Reservation Succesfull, Please Check Your Email For Future Instruction',
              'showSeparator' => true,
              'delay' => 500,
              'pluginOptions' => [
              'showProgressbar' => true,
              'placement' => [
              'from' => 'top',
              'align' => 'center',
              ]
              ]
            ]);
     }
     else{
      $session      = session_unset();
     }

      $session =Yii::$app->session;
      $session->open();
    /*if (($connection = $this->checkConnection()) === true) {
        $this->updateKurs();
    }*/
    
    if (Yii::$app->request->isAjax) {
        $data = Yii::$app->request->post();
        $sort = $data['val'];
        $lokasi = $data['vlok'];
        $jenisD = $data['vjds'];
        $cur = $data['curx'];

        if ($sort == 1) {
            $sort = SORT_ASC;
        }elseif ($sort == 2) {
            $sort = SORT_DESC;
        }else{
            $sort = SORT_ASC;
        }

        if ($cur !== 'USD') {

            $kurs =  $this->kursTable($cur);
            $session['currency'] = $cur;

        }else{
            $kurs =  $this->kursTable();
            $session['currency'] = 'USD';
        }

       $dataProviders = $this->pencarian($lokasi, $jenisD, $sort);

    }else{
        $sort = SORT_ASC;
        $dataProviders = TPost::find()->joinWith('idDestinasi')->where(['t_destinasi.id_status'=>1])->orderBy(['id'=>$sort]);
       
        $kurs =  $this->kursTable();
        $session['currency'] = 'USD';
        
    }

     $countQuery = clone $dataProviders;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'defaultPageSize' => 6]);
        $dataProvider = $dataProviders->offset($pages->offset)
        ->limit($pages->limit)
        ->all();

        if ($dataProvider == null) {
            $lowerCost    = null;
            if ($cur !== 'USD') {

            $kurs =  $this->kursTable($cur);
        }

        }else{
            
            foreach ($dataProvider as $key => $value) {
            $lowerCost[$key] = $this->lowerCost($value->id_destinasi);
            }

        }

        $this->layout   = 'slide';
        $Carrousel      = TCarrousel::find()->groupBy('id_post')->all();
        $listLokasi     = ArrayHelper::map(LokasiDestinasi::find()->all(), 'id', 'lokasi');
        $jenidDestinasi = ArrayHelper::map(TJenisDestinasi::find()->all(), 'id', 'jenis_destinasi');
        $listCurrency   = ArrayHelper::map(TKurs::find()->all(), 'id', 'id');


        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'lowerCost'=>$lowerCost,
            'kurs'=>$kurs,
            'pages' => $pages,
           

        ]);
    }

    protected function kursTable($currency = 'USD'){
        if (($modelKurs = TKurs::findOne($currency)) !== null) {
            return $modelKurs;
        }else{
             throw new NotFoundHttpException('Error While Processing Your Request');
            
        }
    }
protected function checkConnection(){
        $connected = @fsockopen("www.google.com", 80); 
                                        //website, port  (try 80 or 443)
    if ($connected){
        $is_conn = true; //action when connected
        fclose($connected);
    }else{
        $is_conn = false; //action in connection failure
    }
    return $is_conn;
}

    protected function updateKurs(){
        $modelKurs = TKurs::find()->all();
        $now = date('Y-m-d H:i:s');

        $update_at = date($modelKurs[0]->update_at);
        $expKurs = strtotime ( '+30 minute' , strtotime ( $update_at ) ) ;
        $expKurs = date ('Y-m-d H:i:s' , $expKurs );
     //   $update_at = strtotime('+1 minute',);

        if ( $expKurs < $now) {
           
                foreach ($modelKurs as $value) {
                 $get    = file_get_contents("https://www.google.com/finance/converter?a=1&from=".$value->id."&to=IDR");
                 $get    = explode("<span class=bld>",$get);
                 $get    = explode("</span>",$get[1]);  
                 $kurs_asli  = preg_replace("/[^0-9\.]/", null, $get[0]);  
                 $kurs_round = round($kurs_asli,0,PHP_ROUND_HALF_UP); // 044 ke bawah ... 0.5 ke atas s
                 $value->round_kurs = $kurs_round;
                 $value->update_at = date('Y-m-d H:i:s');
                 $value->save();
            }
            
            
        }
        
                 
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->layout = 'login-layout';
            return $this->goBack();
        } else {
            $this->layout = 'login-layout';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionEmail(){
      return $this->render('email');
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['webEmail'])) {
                Yii::$app->session->setFlash('success', 'Terimakasih, permintaan anda sedang kami proses dan akan kami balas ke email anda');
            } else {
                Yii::$app->session->setFlash('error', 'Mohon maaf, terjadi kesalahan, silahkan coba beberapa saat lagi');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
   /* public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
  /*  public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
   /* public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }*/
}
