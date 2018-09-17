<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rental".
 *
 * @property integer $id
 * @property string $start_date
 * @property string $end_date
 * @property string $price_daily
 * @property string $price_total
 * @property integer $vehicle_id
 *
 * @property Vehicle $vehicle
 */
class Rental extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rental';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_date', 'end_date'], 'safe'],
            [['price_daily', 'price_total'], 'number'],
            [['price_total', 'vehicle_id'], 'required'],
            [['vehicle_id'], 'integer'],
            [['vehicle_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vehicle::className(), 'targetAttribute' => ['vehicle_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'price_daily' => 'Price Daily [zł]',
            'price_total' => 'Price Total [zł]',
            'vehicle_id' => 'Vehicle ID',
        ];
    }

    public function getVehicleName() {
        $vehicle = Vehicle::find()->where(['id' => $this->vehicle_id])->one();
        if ($vehicle === null) {
            return 'Niepowiązany z pojazdem';
        }
        return $vehicle->make . ' ' . $vehicle->year;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicle()
    {
        return $this->hasOne(Vehicle::className(), ['id' => 'vehicle_id']);
    }
}
