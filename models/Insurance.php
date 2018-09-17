<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "insurance".
 *
 * @property integer $id
 * @property string $company
 * @property string $startson
 * @property string $endson
 * @property integer $price
 * @property integer $pricenextyear
 *
 * @property Vehicle $vehicle
 */
class Insurance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'insurance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company', 'insurancenumber'], 'string'],
            [['startson', 'endson'], 'safe'],
            [['price', 'pricenextyear', 'valid', 'vehicleid'], 'integer'],
            //['endson', 'compare', 'compareAttribute' => 'startson', 'operator' => '<=', 'message' => 'Data konca nie moze byc przed data poczatku'], //doesnt work properly
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company' => 'Company',
            'startson' => 'Starts on',
            'endson' => 'Ends on',
            'price' => 'Price (zł)',
            'pricenextyear' => 'Price next year (zł)',
            'valid' => 'Valid',
            'insurancenumber' => 'Policy number',
            'vehicleid' => 'Insured vehicle',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicle()
    {
        return $this->hasOne(Vehicle::className(), ['id' => 'id']);
    }

    public function getVehicleName() {
        $vehicle = Vehicle::find()->where(['id' => $this->vehicleid])->one();
        if ($vehicle === null) {
            return 'Not related to a vehicle';
        }
        return $vehicle->make . ' ' . $vehicle->year;
    }

    public function getInsuranceName()
    {
        return $this->company . ' polisa nr ' . $this->insurancenumber;
    }

    public function convertToEvent()
    {
        $event = new \yii2fullcalendar\models\Event();
        $event->id = $this->id;
        $event->title = $this->getInsuranceName();
        $event->start = date('Y-m-d', strtotime($this->endson));
        $event->end = $event->start;
        return $event;
    }

}
