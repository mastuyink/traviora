<?php

namespace backend\controllers;

use Yii;
use app\models\WaktuJemput;
use app\models\WaktuJemputSearch;
use app\models\TDestinasi;
use app\models\TLokasiAj;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
/**
 * WaktuJemputController implements the CRUD actions for WaktuJemput model.
 */
class WaktuJemputController extends Controller
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
     * Lists all WaktuJemput models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WaktuJemputSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WaktuJemput model.
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
     * Creates a new WaktuJemput model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model     = new WaktuJemput();
        $Lokasi    = ArrayHelper::map(TLokasiAj::find()->where('id != :id',[':id'=>1])->all(), 'id', 'lokasi_aj');
        $Destinasi = ArrayHelper::map(TDestinasi::find()->all(), 'id', 'nama_destinasi');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('create');
        } else {
            return $this->render('create', [
                'model' => $model,
                'Destinasi'=>$Destinasi,
                'Lokasi'=>$Lokasi,
            ]);
        }
    }

    /**
     * Updates an existing WaktuJemput model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $Lokasi    = ArrayHelper::map(TLokasiAj::find()->where('id != :id',[':id'=>1])->all(), 'id', 'lokasi_aj');
        $Destinasi = ArrayHelper::map(TDestinasi::find()->all(), 'id', 'nama_destinasi');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                'model' => $model,
                'Destinasi'=>$Destinasi,
                'Lokasi'=>$Lokasi,
            ]);
        }
    }

    /**
     * Deletes an existing WaktuJemput model.
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
     * Finds the WaktuJemput model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WaktuJemput the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WaktuJemput::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
