<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "garage".
 *
 * @property integer $id
 * @property integer $capacity
 * @property integer $used_spots
 * @property string $city
 * @property string $address
 * @property string $house_number
 * @property string $postal_code
 *
 * @property Vehicle[] $vehicles
 */
class Garage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'garage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['capacity', 'used_spots'], 'integer'],
            [['city', 'address', 'house_number', 'postal_code'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'capacity' => 'Capacity (max number of cars)',
            'used_spots' => 'Used Spots',
            'city' => 'City',
            'address' => 'Address',
            'house_number' => 'House Number',
            'postal_code' => 'Postal Code',
        ];
    }

    public function getGarageName()
    {
        return $this->address . ' ' . $this->house_number . ' ' . $this->city;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicles()
    {
        return $this->hasMany(Vehicle::className(), ['garage_id' => 'id']);
    }
}
