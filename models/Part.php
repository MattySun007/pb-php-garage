<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "part".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property string $price
 *
 * @property ServiceParts[] $serviceParts
 */
class Part extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'part';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['name'], 'string'],
            [['type'], 'integer'],
            [['price'], 'number'],
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
            'type' => 'Type',
            'price' => 'Price [zł]',
        ];
    }

    public function getPartType() {
        if ($this->type == 0) {
            return 'Części eksploatacyjne';
        }
        if ($this->type == 1) {
            return 'Zawieszenie';
        }
        if ($this->type == 2) {
            return 'Części silnikowe';
        }
        if ($this->type == 3) {
            return 'Płyny (oleje, smary itd)';
        }
        if ($this->type == 4) {
            return 'Tuning';
        }
        if ($this->type == 5) {
            return 'Części związane z instalacjami gazowymi';
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceParts()
    {
        return $this->hasMany(ServiceParts::className(), ['part_id' => 'id']);
    }
}
