<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_shop".
 *
 * @property integer $id
 * @property string $name
 * @property integer $phone_number
 * @property string $city
 * @property string $hours_working
 * @property string $rebate
 * @property string $address
 * @property string $house_number
 * @property string $postal_code
 *
 * @property Service[] $services
 */
class ServiceShop extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_shop';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'city', 'hours_working', 'address', 'house_number', 'postal_code'], 'string'],
            [['phone_number'], 'integer'],
            [['rebate'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'phone_number' => 'Phone Number',
            'city' => 'City',
            'hours_working' => 'Hours Working',
            'rebate' => 'Rebate',
            'address' => 'Address',
            'house_number' => 'House Number',
            'postal_code' => 'Postal Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Service::className(), ['service_shop_id' => 'id']);
    }
}
