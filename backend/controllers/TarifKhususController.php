<?php

namespace backend\controllers;

use Yii;
use app\models\TBiayaKhusus;
use app\models\TBiayaKhususSearch;
use app\models\TBiaya;
use app\models\TDestinasi;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * TBiayaKhususController implements the CRUD actions for TBiayaKhusus model.
 */
class TarifKhususController extends Controller
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
     * Lists all TBiayaKhusus models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TBiayaKhususSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TBiayaKhusus model.
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
     * Creates a new TBiayaKhusus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelKhusus = new TBiayaKhusus();
        $Destinasi = ArrayHelper::map(TDestinasi::find()->all(), 'id', 'nama_destinasi');
        $modelBiaya = new TBiaya();

        if ($modelBiaya->load(Yii::$app->request->post()) && $modelKhusus->load(Yii::$app->request->post()) && $modelBiaya->validate()) {
            $modelBiaya->save(false);
            $modelKhusus->id_biaya = $modelBiaya->id;
            $modelKhusus->save();
            return $this->redirect('index');
        } else {
            return $this->render('create', [
                'modelKhusus' => $modelKhusus,
                'modelBiaya'=>$modelBiaya,
                'Destinasi'=>$Destinasi,
            ]);
        }
    }

    /**
     * Updates an existing TBiayaKhusus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $modelKhusus = $this->findModel($id);
        $Destinasi   = ArrayHelper::map(TDestinasi::find()->all(), 'id', 'nama_destinasi');
        $modelBiaya  = new TBiaya();
        
        if ($modelKhusus->load(Yii::$app->request->post()) && $modelKhusus->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                'modelKhusus' => $modelKhusus,
                'modelBiaya'=>$modelBiaya,
                'Destinasi'=>$Destinasi,
            ]);
        }
    }

    /**
     * Deletes an existing TBiayaKhusus model.
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
     * Finds the TBiayaKhusus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TBiayaKhusus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($modelKhusus = TBiayaKhusus::findOne($id)) !== null) {
            return $modelKhusus;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
