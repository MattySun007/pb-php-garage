<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "owner".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property integer $phone
 * @property string $city
 * @property string $postal_code
 * @property string $adress
 * @property string $home_number
 *
 * @property Vehicle[] $vehicles
 */
class Owner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'owner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['first_name', 'last_name', 'city', 'postal_code', 'adress', 'home_number'], 'string'],
            [['phone'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'phone' => 'Phone',
            'city' => 'City',
            'postal_code' => 'Postal Code',
            'adress' => 'Adress',
            'home_number' => 'Home Number',
        ];
    }

    public function getOwnerName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicles()
    {
        return $this->hasMany(Vehicle::className(), ['owner_id' => 'id']);
    }
}
