<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "refuel".
 *
 * @property integer $id
 * @property string $type
 * @property double $amount
 * @property double $cost
 * @property integer $vehicle
 *
 * @property Vehicle $id0
 */
class Refuel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'refuel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'string'],
            [['amount', 'cost'], 'number'],
            //[['vehicle'], 'integer'],
            [
                ['vehicle'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Vehicle::className(),
                'targetAttribute' => ['vehicle' => 'id']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'amount' => 'Amount (litres)',
            'cost' => 'Cost (total) (zł)',
            'vehicle' => 'Vehicle',
        ];
    }

    public function getVehicleName() {
        $vehicle = Vehicle::find()->where(['id' => $this->vehicle])->one();
        if ($vehicle === null) {
            return 'Niepowiązany z pojazdem';
        }
        return $vehicle->make . ' ' . $vehicle->year;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Vehicle::className(), ['id' => 'id']);
    }

    public function getUnitCost()
    {
        return $this->cost / $this->amount; //returns cost per unit (litre)
    }
}
