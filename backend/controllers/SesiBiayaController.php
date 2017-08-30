<?php

namespace backend\controllers;

use Yii;
use app\models\TSesiBiaya;
use app\models\TSesiBiayaSearch;
use app\models\TJenisSesi;
use app\models\TBiaya;
use app\models\TDestinasi;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * TSesiBiayaController implements the CRUD actions for TSesiBiaya model.
 */
class SesiBiayaController extends Controller
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
     * Lists all TSesiBiaya models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TSesiBiayaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TSesiBiaya model.
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
     * Creates a new TSesiBiaya model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelSesi = new TSesiBiaya();
        $jenisSesi = ArrayHelper::map(TJenisSesi::find()->all(), 'id', 'jenis_sesi');
        $Destinasi = ArrayHelper::map(TDestinasi::find()->all(), 'id', 'nama_destinasi');
        $modelBiaya = new TBiaya();

        if ($modelBiaya->load(Yii::$app->request->post()) && $modelSesi->load(Yii::$app->request->post()) && $modelBiaya->validate()) {

            $modelBiaya->save(false);
            $modelSesi->id_biaya = $modelBiaya->id;
            $modelSesi->save();
            return $this->redirect('index');
        } 
            return $this->render('create', [
                'modelSesi' => $modelSesi,
                'jenisSesi'=>$jenisSesi,
                'modelBiaya'=>$modelBiaya,
                'Destinasi'=>$Destinasi,
            ]);
        
    }

    /**
     * Updates an existing TSesiBiaya model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $modelSesi = $this->findModel($id);
        $jenisSesi = ArrayHelper::map(TJenisSesi::find()->all(), 'id', 'jenis_sesi');
        $Destinasi = ArrayHelper::map(TDestinasi::find()->all(), 'id', 'nama_destinasi');
        $modelBiaya = TBiaya::findOne($modelSesi->id_biaya);
         if ($modelBiaya->load(Yii::$app->request->post()) && $modelSesi->load(Yii::$app->request->post()) && $modelBiaya->validate()) {

            $modelBiaya->save(false);
            $modelSesi->id_biaya = $modelBiaya->id;
            $modelSesi->save();
            return $this->redirect('index');
        } 
            return $this->render('update', [
                'modelSesi' => $modelSesi,
                'jenisSesi'=>$jenisSesi,
                'modelBiaya'=>$modelBiaya,
                'Destinasi'=>$Destinasi,
            ]);
        
    }

    /**
     * Deletes an existing TSesiBiaya model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        
        $hapus = $this->findModel($id);
        $dest = TDestinasi::findOne($hapus->id_destinasi);
        $dest->load('id_status');
        $dest->id_status = '3';
        $dest->save();
        $hapus->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TSesiBiaya model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TSesiBiaya the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TSesiBiaya::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
