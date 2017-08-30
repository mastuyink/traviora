<?php

namespace backend\controllers;

use Yii;
use app\models\TLiburTrip;
use app\models\TLiburTripSearch;
use app\models\TDestinasi;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Model;

/**
 * TLiburTripController implements the CRUD actions for TLiburTrip model.
 */
class LiburTripController extends Controller
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
     * Lists all TLiburTrip models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TLiburTripSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TLiburTrip model.
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
     * Creates a new TLiburTrip model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = [new TLiburTrip];
        $des   = ArrayHelper::map(TDestinasi::find()->all(), 'id','nama_destinasi');

        if (Yii::$app->request->isPost) {

            $model = Model::createMultiple(TLiburTrip::classname());
            Model::loadMultiple($model, Yii::$app->request->post());
            Model::validateMultiple($model);
                
                    $transaction = Yii::$app->db->beginTransaction();
                    try {
                       
                            foreach ($model as $LiburTrip) {
                                if (! ($flag = $LiburTrip->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        
                        if ($flag) {
                            $transaction->commit();
                            return $this->redirect('index');
                        }
                    } catch (Exception $e) {
                      $transaction->rollBack();
                    }
                
           
        } else {
            return $this->render('create', [
                'model'=>(empty($model)) ? [new TLiburTrip] : $model,
                'des'=>$des,
            ]);
        }
    }

    /**
     * Updates an existing TLiburTrip model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TLiburTrip model.
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
     * Finds the TLiburTrip model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TLiburTrip the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TLiburTrip::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
