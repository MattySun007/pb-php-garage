<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "service".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $date
 * @property integer $mileage
 * @property double $cost
 * @property integer $vehicle
 * @property integer $type
 *
 * @property Vehicle $id0
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'string'],
            [['date'], 'safe'],
            [['mileage', 'vehicle', 'type', 'service_shop_id'], 'integer'],
            [['cost'], 'number'],
            /*[
                ['id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Vehicle::className(),
                'targetAttribute' => ['id' => 'id']
            ],
            [
                ['service_shop_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => ServiceShop::className(),
                'targetAttribute' => ['id' => 'id']
            ],*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'date' => 'Date',
            'mileage' => 'Mileage (km)',
            'cost' => 'Cost (zł)',
            'vehicle' => 'Vehicle',
            'type' => 'Type',
            'service_shop_id' => 'Servicing shop',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Vehicle::className(), ['id' => 'id']);
    }

    public function getServiceShopName() {
        $serviceShop = ServiceShop::find()->where(['id' => $this->service_shop_id])->one();
        if (!isset($serviceShop)) {
            return 'Not selected';
        }
        return $serviceShop->name;
    }

    public function getUsedParts()
    {
        $partsarray = [];
        $parts = ServiceParts::find()->where(['service_id' => $this->id])->all();
        if(!empty($parts)) {
            foreach ($parts as $part) {
                array_push($partsarray, $part->part_id);
            }
        }
        return $partsarray;
    }

    public function getServiceName()
    {
        switch ($this->type) {
            case 0:
                return 'Obowiązkowy przegląd techniczny';
            case 1:
                return 'Wymiana oleju';
            case 2:
                return 'Wymiana świec';
            case 3:
                return 'Naprawa zawieszenia';
            case 4:
                return 'Inne';
        }
    }

    public function getVehicleName() {
        $vehicle = Vehicle::find()->where(['id' => $this->vehicle])->one();
        if ($vehicle === null) {
            return 'Niepowiązany z pojazdem';
        }
        return $vehicle->make . ' ' . $vehicle->year;
    }

    public function convertToEvent()
    {
        $vehicle = Vehicle::find()->where(['id' => $this->vehicle])->one();
        $date = date('Y-m-d',
            strtotime($this->date) + (24 * 3600 * 365));
        //przypomnienie po roku od dokonania przeglądu/wymiany oleju/czegos innego
        $event = new \yii2fullcalendar\models\Event();
        $event->id = $this->id;
        $event->title = $this->getServiceName() . ' pojazdu ' . $vehicle->getVehicleName();
        $event->start = date('Y-m-d', strtotime($date));
        $event->end = $event->start;
        return $event;
    }
}
