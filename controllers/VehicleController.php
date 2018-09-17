<?php


namespace app\controllers;

use app\models\Insurance;
use app\models\Rental;
use FPDF;
use Yii;
use app\models\Vehicle;
use app\models\VehicleSearch;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\base\DynamicModel;

require('fpdf.php');


/**
 * VehicleController implements the CRUD actions for Vehicle model.
 */
class VehicleController extends Controller
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
     * Lists all Vehicle models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VehicleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //$insurance = Insurance::find()->where(['id' => $this->findModel($dataProvider)->insurance])->one();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            // 'insurance' => $insurance,
        ]);
    }

    /**
     * Displays a single Vehicle model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $insurance = Insurance::find()->where(['id' => $this->findModel($id)->insurance])->one();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'insurance' => $insurance,
        ]);
    }

    /**
     * Creates a new Vehicle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vehicle();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->garage_id !== null && $model->garage_id != '') { //zmniejszamy ilosc miejsc w garazu
                $garage = \app\models\Garage::find()->where(['id' => $model->garage_id])->one();
                $garage->used_spots++;
                $garage->save();
            }
            $model->photo = UploadedFile::getInstance($model, 'photo');
            if ($model->upload()) {
                $model->photo = $model->photo->baseName . '.' . $model->photo->extension;
                $model->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Vehicle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldGarage = $model->garage_id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //zwiekszamy ilosc miejsc w nowym garazu jesli zmieniono
            if ($model->garage_id !== null) { //jest wprowadzony jakis garaz
                //wybrano brak garażu
                if($model->garage_id === '' && isset($oldGarage)) {
                    $garage = \app\models\Garage::find()->where(['id' => $oldGarage])->one();
                    $garage->used_spots--;
                    $garage->save();
                }
                //zmieniamy garaz na nowy w aucie ktore bylo juz w jakims garazu
                elseif ($model->garage_id != $oldGarage && $model->garage_id !== '') {
                    //zwiekszamy w nowym garazu
                    $garage = \app\models\Garage::find()->where(['id' => $model->garage_id])->one();
                    $garage->used_spots++;
                    $garage->save();
                    //zmniejszamy w starym garazu o ile stary garaż istnieje (nie jest '')
                    if ($oldGarage !== null) {
                        $garage = \app\models\Garage::find()->where(['id' => $oldGarage])->one();
                        $garage->used_spots--;
                        $garage->save();
                    }
                }
                else { //nie rób nic jeśli zmieniamy na ten sam garaż
                }
            }
            //zmniejszamy ilosc miejsc w garazu jesli usunieto auto z garazu
            if ($model->garage_id === null && $oldGarage != null) {
                $garage = \app\models\Garage::find()->where(['id' => $oldGarage])->one();
                $garage->used_spots--;
                $garage->save();
            }

            $model->photo = UploadedFile::getInstance($model, 'photo');
            if ($model->upload()) {
                $model->photo = $model->photo->baseName . '.' . $model->photo->extension;
                $model->save();
            }
            // this will probably fuck things up when nothing's selected and there's already a good pic in the database - will need a new method for updating

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Vehicle model.
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
            echo 'This vehicle has got some bills or insurances connected to it. Please delete them first and then delete
            this vehicle';
        }
    }

    /**
     * Finds the Vehicle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vehicle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vehicle::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionRent($id, $startdate = null, $enddate = null)
    {
        // should probably move the fpdf files from controllers to somewhere? wasn't sure where so I left it there for now, let me know on gitlab what's the proper place to store external libraries
        $model = DynamicModel::validateData(compact('startdate', 'enddate'), [
            [['startdate', 'enddate'], 'date'],
            [['startdate', 'enddate'], 'safe'],
            ['startdate', 'compare', 'compareAttribute' => 'enddate', 'operator' => '<='],

            ]);
        $vehicle = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {

                $rental = new Rental();
                $rental->start_date = $model->startdate;
                $rental->end_date = $model->enddate;
                $rental->price_total = $vehicle->rentalcost($model->startdate, $model->enddate);
                $rental->vehicle_id = $vehicle->id;
                $rental->price_daily = $vehicle->rentcost;
                $rental->save();


                // I know this is absolutely disgusting to look at, but I wasn't sure where to put all the text needed to generate this PDF
                $pdf = new FPDF();
                $pdf->AddPage();
                $pdf->SetFont('Times', 'B', 16);
                $pdf->Cell(0, 10, 'Grajewo, dnia ' . date('d-m-Y'), 0, 1, 'C');
                $pdf->Cell(0, 10, 'UMOWA WYNAJMU POJAZDU ' . $vehicle->getVehicleName(), 0, 1, 'C');
                $pdf->SetFont('Times', 'B', 11);
                $pdf->Cell(0, 10, 'Umowa zawarta od dnia ' . $model->startdate . ' do dnia ' . $model->enddate
                    . ' pomiedzy panem .....................................................,', 0, 1, 'C');
                $pdf->Cell(0, 10, 'zam. ......................................................................', 0, 1,
                    'C');
                $pdf->Cell(0, 10, 'a. ......................................................................,', 0, 1,
                    'C');
                $pdf->Cell(0, 10, 'zam. ......................................................................', 0, 1,
                    'C');
                $pdf->Cell(0, 10, 'na kwote ' . $vehicle->rentalcost($model->startdate, $model->enddate) . 'zl', 0, 1,
                    'C');
                // jakies formulki prawnicze co do wynajmu dodac tutaj jeszcze
                $pdf->SetY(-40);
                $pdf->Cell(40, 0, 'Podpis wynajmujacego');
                $pdf->Cell(250, 0, 'Podpis najemcy', 0, 1, 'C');
                return $pdf->Output("umowa.pdf", 'D');
            }
        }

        return $this->render('rent', [
            'model' => $model,
        ]);
    }
}
