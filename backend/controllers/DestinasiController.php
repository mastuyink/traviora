<?php

namespace backend\controllers;

use Yii;
use app\models\TDestinasi;
use app\models\TDestinasiSearch;
use app\models\TJenisDestinasi;
use app\models\THariTrip;
use app\models\TLiburTrip;
use app\models\LokasiDestinasi;
use app\models\TSesiBiaya;
use app\models\TSupplier;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Model;
use yii\helpers\Json;
/**
public function behaviors(){
        
        return true;
    }
 * TDestinasiController implements the CRUD actions for TDestinasi model.
 */
class DestinasiController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $listD = TDestinasi::find()->where(['id_status'=>3])->all();
        Model::loadMultiple($listD,'id_status');
        foreach ($listD as $key => $value) {
           
            if (( $Biaya = TSesiBiaya::findOne(['id_destinasi'=>$value->id])) == null) {
              $value->id_status = '3';
              $value->save();
           }else{
            $value->id_status = '1';
              $value->save();
           }
        }
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
     * Lists all TDestinasi models.
     * @return mixed
     */
    public function actionIndex()
    {
       //  $this->layout = 'no-tab';
        $searchModel = new TDestinasiSearch();
         $jenisd = ArrayHelper::map(TJenisDestinasi::find()->all(), 'id', 'jenis_destinasi');
         $Des = ArrayHelper::map(TDestinasi::find()->all(), 'nama_destinasi', 'nama_destinasi');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if (Yii::$app->request->post('hasEditable')) {
        // instantiate your book model for saving
        $idDest = Yii::$app->request->post('editableKey');
        $model = $this->findModel($idDest);

        // store a default json response as desired by editable
        $out = Json::encode(['output'=>'', 'message'=>'']);

        // fetch the first entry in posted data (there should only be one entry 
        // anyway in this array for an editable submission)
        // - $posted is the posted data for Book without any indexes
        // - $post is the converted array for single model validation
        $posted = current($_POST['TDestinasi']);
        $post = ['TDestinasi' => $posted];

        // load model like any single model validation
        if ($model->load($post)) {
        // can save model or do something before saving model
        $model->save();

        // custom output to return to be displayed as the editable grid cell
        // data. Normally this is empty - whereby whatever value is edited by
        // in the input by user is updated automatically.
        $output = '';

        // specific use case where you need to validate a specific
        // editable column posted when you have more than one
        // EditableColumn in the grid view. We evaluate here a
        // check to see if buy_amount was posted for the Book model
       /* if (isset($posted['buy_amount'])) {
        $output = Yii::$app->formatter->asDecimal($model->buy_amount, 2);
        }*/

        // similarly you can check if the name attribute was posted as well
        // if (isset($posted['name'])) {
        // $output = ''; // process as you need
        // }
        $out = Json::encode(['output'=>$output, 'message'=>'']);
        }
        // return ajax json encoded response and exit
        echo $out;
        return;
    }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'jenisd'=>$jenisd,
            'Des'=>$Des,
        ]);
    }

    /**
     * Displays a single TDestinasi model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        // $this->layout = 'no-tab';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TDestinasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // $this->layout = 'no-tab';
        $model = new TDestinasi();
        $hariTrip = new THariTrip();
        $jenisd = ArrayHelper::map(TJenisDestinasi::find()->all(), 'id', 'jenis_destinasi');
        $lokasi = ArrayHelper::map(LokasiDestinasi::find()->all(), 'id', 'lokasi');
        $supplier = ArrayHelper::map(TSupplier::find()->all(), 'id', 'nama');
        $liburTtrip = [new TLiburTrip];
        if ($model->load(Yii::$app->request->post()) && $hariTrip->load(Yii::$app->request->post()) ) {
            //$model->save();
            
            $liburTtrip = Model::createMultiple(TLiburTrip::classname());
           if (!empty(Model::loadMultiple($liburTtrip, Yii::$app->request->post()))) {
                # code...
            
            // validate all models
                $valid = $model->validate();
                $valid = Model::validateMultiple($liburTtrip) && $valid;
                if ($valid) {
                    $transaction = Yii::$app->db->beginTransaction();
                    try {
                        if ($flag = $model->save(false)) {
                            $hariTrip->id_destinasi = $model->id;
                            $hariTrip->save();
                            foreach ($liburTtrip as $LiburTrip) {
                                $LiburTrip->id_destinasi = $model->id;
                                if (! ($flag = $LiburTrip->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        }
                        if ($flag) {
                            $transaction->commit();
                            return $this->redirect('index');
                        }
                    } catch (Exception $e) {
                      $transaction->rollBack();
                    }
                }
            }else{
                $model->validate();
                $model->save(false);
                $hariTrip->id_destinasi = $model->id;
                $hariTrip->save(false);
                return $this->redirect('index');
             }
           
        }
            return $this->render('create', [
                'model' => $model,
                'jenisd'=>$jenisd,
                'hariTrip'=>$hariTrip,
                'lokasi'=>$lokasi,
                'supplier'=>$supplier,
                'liburTtrip'=>(empty($liburTtrip)) ? [new TLiburTrip] : $liburTtrip,
            ]);
        
    }

    /**
     * Updates an existing TDestinasi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        // $this->layout = 'no-tab';
        $model = $this->findModel($id);
         $hariTrip = THariTrip::find()->where(['id_destinasi'=>$model->id])->one();
        $jenisd = ArrayHelper::map(TJenisDestinasi::find()->all(), 'id', 'jenis_destinasi');
        $lokasi = ArrayHelper::map(LokasiDestinasi::find()->all(), 'id', 'lokasi');
        $liburTtrip = TLiburTrip::find()->where(['id_destinasi'=>$model->id])->all();
         $supplier = ArrayHelper::map(TSupplier::find()->all(), 'id', 'nama');
       if ($model->load(Yii::$app->request->post()) && $hariTrip->load(Yii::$app->request->post()) ) {
            //$model->save();
            //$hariTrip->id_destinasi = $model->id;
            $hariTrip->id_destinasi = $model->id;
            $hariTrip->save();

            $oldIDs = ArrayHelper::map($liburTtrip, 'id', 'id');
            $liburTtrip = Model::createMultiple(TLiburTrip::classname(), $liburTtrip);
            Model::loadMultiple($liburTtrip, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($liburTtrip, 'id', 'id')));

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($liburTtrip) && $valid;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            TLiburTrip::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($liburTtrip as $modelAddress) {
                            $modelAddress->id_destinasi = $model->id;
                            if (! ($flag = $modelAddress->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect('index');
                    }

                } catch (Exception $e) {
                    $transaction->rollBack();
                }
           }

            
        }
            return $this->render('update', [
                'model' => $model,
                'jenisd'=>$jenisd,
                'hariTrip'=>$hariTrip,
                'lokasi'=>$lokasi,
                'supplier'=>$supplier,
                'liburTtrip'=>(empty($liburTtrip)) ? [new TLiburTrip] : $liburTtrip,
    
            ]);
        
    }


       /* $modelCustomer = $this->findModel($id);
        $modelsAddress = $modelCustomer->addresses;

        if ($modelCustomer->load(Yii::$app->request->post())) {
            $oldIDs = ArrayHelper::map($modelsAddress, 'id', 'id');
            $modelsAddress = Model::createMultiple(Address::classname(), $modelsAddress);
            Model::loadMultiple($modelsAddress, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsAddress, 'id', 'id')));
            // validate all models
            $valid = $modelCustomer->validate();
            $valid = Model::validateMultiple($modelsAddress) && $valid;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelCustomer->save(false)) {
                        if (!empty($deletedIDs)) {
                            Address::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsAddress as $modelAddress) {
                            $modelAddress->customer_id = $modelCustomer->id;
                            if (! ($flag = $modelAddress->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelCustomer->id]);
                    }

                } catch (Exception $e) {
                    $transaction->rollBack();
                }
           }
        }
        return $this->render('update', [
        'modelCustomer' => $modelCustomer,
            'modelsAddress' => (empty($modelsAddress)) ? [new Address] : $modelsAddress
        ]);*/
    /**
     * Deletes an existing TDestinasi model.
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
     * Finds the TDestinasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TDestinasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TDestinasi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
