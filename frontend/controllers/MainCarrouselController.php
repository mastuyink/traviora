<?php

namespace frontend\controllers;

use Yii;
use app\models\TMainCarrousel;
use app\models\TMainCarrouselSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
/**
 * MainCarrouselController implements the CRUD actions for TMainCarrousel model.
 */
class MainCarrouselController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['update', 'index','create','delete','view'],
                        'allow' => true,
                       'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TMainCarrousel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TMainCarrouselSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TMainCarrousel model.
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
     * Creates a new TMainCarrousel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TMainCarrousel();

        if (Yii::$app->request->isPost) {

             $model->carrousel = UploadedFile::getInstance($model, 'carrousel');
            if ($model->upload()) {
                $model->save();
               return $this->redirect('index');
            }else{
                throw new NotFoundHttpException('Mohon maaf, Telah Terjadi Kesalahan');
            }
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TMainCarrousel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
             $model->carrousel = UploadedFile::getInstance($model, 'carrousel');
            if ($model->uploadup($id)) {
                $model->save();
               return $this->redirect('index');
            }else{
                throw new NotFoundHttpException('Mohon maaf, Telah Terjadi Kesalahan');
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TMainCarrousel model.
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
     * Finds the TMainCarrousel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TMainCarrousel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TMainCarrousel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
