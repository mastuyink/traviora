<?php

namespace backend\controllers;

use Yii;
use app\models\TLimitDestinasi;
use app\models\TLimitDestinasiSearch;
use app\models\TDestinasi;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use kartik\widgets\Growl;

/**
 * TLimitDestinasiController implements the CRUD actions for TLimitDestinasi model.
 */
class LimitDestinasiController extends Controller
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
     * Lists all TLimitDestinasi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TLimitDestinasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TLimitDestinasi model.
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
     * Creates a new TLimitDestinasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TLimitDestinasi();
        $Destinasi = ArrayHelper::map(TDestinasi::find()->all(), 'id', 'nama_destinasi');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             echo Growl::widget([
              'type' => Growl::TYPE_MINIMALIST,
              'title' => 'Ok!',
              'icon' => 'glyphicon glyphicon-check',
              'body' => 'Data Saved',
              'showSeparator' => true,
              'delay' => 200,
              'pluginOptions' => [
              'showProgressbar' => true,
              'placement' => [
              'from' => 'top',
              'align' => 'center',
              ]
              ]
            ]);
            return $this->redirect('create');
        } else {
            return $this->render('create', [
                'model' => $model,
                'Destinasi'=>$Destinasi,
            ]);
        }
    }

    /**
     * Updates an existing TLimitDestinasi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $Destinasi = ArrayHelper::map(TDestinasi::find()->all(), 'id', 'nama_destinasi');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            echo Growl::widget([
              'type' => Growl::TYPE_INFO,
              'title' => 'Ok!',
              'icon' => 'glyphicon glyphicon-check',
              'body' => 'Data Saved',
              'showSeparator' => true,
              'delay' => 200,
              'pluginOptions' => [
              'showProgressbar' => true,
              'placement' => [
              'from' => 'top',
              'align' => 'center',
              ]
              ]
            ]);
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                'model' => $model,
                'Destinasi'=>$Destinasi,
            ]);
        }
    }

    /**
     * Deletes an existing TLimitDestinasi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        echo Growl::widget([
              'type' => Growl::TYPE_WARNING,
              'title' => 'Ok!',
              'icon' => 'glyphicon glyphicon-check',
              'body' => 'Data Saved',
              'showSeparator' => true,
              'delay' => 200,
              'pluginOptions' => [
              'showProgressbar' => true,
              'placement' => [
              'from' => 'top',
              'align' => 'center',
              ]
              ]
            ]);
        return $this->redirect(['index']);
    }

    /**
     * Finds the TLimitDestinasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TLimitDestinasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TLimitDestinasi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
