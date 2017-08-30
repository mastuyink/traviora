<?php

namespace backend\controllers;

use Yii;
use app\models\TarifAj;
use app\models\Caritarif;
use app\models\TDestinasi;
use app\models\AreaAj;
use app\models\TLokasiAj;
use app\models\JenisTarifAj;
use app\models\TTransport;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * TarifAjController implements the CRUD actions for TarifAj model.
 */
class TarifAjController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TarifAj models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Caritarif();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TarifAj model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


public function actionArea($id_lokasi){
         $countPosts = AreaAj::find()->where(['id_lokasi_aj' => $id_lokasi])->count();
         
         $posts = AreaAj::find()->where(['id_lokasi_aj' => $id_lokasi])->orderBy('nama_area DESC')->all();
         
         if($countPosts>0){
            echo "<option> ... </option>";
         foreach($posts as $post){
         echo "<option value='".$post->id."'>".$post->nama_area."</option>";
         }
         }
         else{
         echo "<option> -> empty <-</option>";
         }
     
     }
    /**
     * Creates a new TarifAj model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model     = new TarifAj();
        $Destinasi = ArrayHelper::map(TDestinasi::find()->all(), 'id', 'nama_destinasi');
        $Area      = ArrayHelper::map(AreaAj::find()->all(), 'id', 'nama_area');
        $jenis     = ArrayHelper::map(JenisTarifAj::find()->where('id != :id',[':id'=>1])->all(), 'id', 'jenis_tarif');
       
        $Lokasi = ArrayHelper::map(TLokasiAj::find()->where('id != :id',[':id'=>1])->all(), 'id', 'lokasi_aj');


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('create', [
                'model' => $model,
                'Destinasi'=>$Destinasi,
                'Area'=>$Area,
                'jenis'=>$jenis,
                'Lokasi'=>$Lokasi,
            ]);
        }
    }

    /**
     * Updates an existing TarifAj model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $Destinasi = ArrayHelper::map(TDestinasi::find()->all(), 'id', 'nama_destinasi');
        $Area      = ArrayHelper::map(AreaAj::find()->all(), 'id', 'nama_area');
        $jenis     = ArrayHelper::map(JenisTarifAj::find()->where('id != :id',[':id'=>1])->all(), 'id', 'jenis_tarif');
       
        $Lokasi = ArrayHelper::map(TLokasiAj::find()->where('id != :id',[':id'=>1])->all(), 'id', 'lokasi_aj');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                'model' => $model,
                'Destinasi'=>$Destinasi,
                'Area'=>$Area,
                'jenis'=>$jenis,
                'Lokasi'=>$Lokasi,
            ]);
        }
    }

    /**
     * Deletes an existing TarifAj model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TarifAj model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TarifAj the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TarifAj::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
