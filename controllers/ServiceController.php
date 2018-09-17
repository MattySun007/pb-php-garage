<?php

namespace app\controllers;

use app\models\ServiceParts;
use Yii;
use app\models\Service;
use app\models\ServiceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Vehicle;


/**
 * ServiceController implements the CRUD actions for Service model.
 */
class ServiceController extends Controller
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
     * Lists all Service models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Service model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $vehicle = Vehicle::find()->where(['id' => $this->findModel($id)->vehicle])->one();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'vehicle' => $vehicle,
        ]);
    }

    /**
     * Creates a new Service model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Service();
        $parts = new ServiceParts();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $parts->load(Yii::$app->request->post());
            if (isset($_POST['ServiceParts'])) {
                foreach($_POST['ServiceParts'] as $key => $value) { //pobieramy czesci wybrane z checkboxa
                    if ($value !== '') {
                        foreach ($value as $val) {
                            $part = new ServiceParts();
                            $part->service_id = $model->id;
                            $part->part_id = $val;
                            $part->save();
                        }
                    }
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);

        } else {
            return $this->render('create', [
                'model' => $model,
                'partsModel' => $parts,
            ]);
        }
    }

    /**
     * Updates an existing Service model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $parts = new ServiceParts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $parts->load(Yii::$app->request->post());
            if (isset($_POST['ServiceParts'])) {

                //usuwamy czesci zwiazane z naprawa przy updacie
                $serviceParts = \app\models\ServiceParts::find()->where(['service_id' => $model->id])->all();
                foreach ($serviceParts as $part) {
                    $part->delete();
                }
                foreach($_POST['ServiceParts'] as $key => $value) { //pobieramy czesci wybrane z checkboxa
                    if ($value !== '') {
                        foreach ($value as $val) {
                            $part = new ServiceParts();
                            $part->service_id = $model->id;
                            $part->part_id = $val;
                            $part->save();
                        }
                    }
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'partsModel' => $parts,
            ]);
        }
    }

    /**
     * Deletes an existing Service model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        }
        catch(Exception $e) {
            echo 'This service part has used some parts. Please delete them first to delete this service first';
        }
    }

    /**
     * Finds the Service model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Service the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Service::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findParts($id)
    {
        if (($model = Service::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
