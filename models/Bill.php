<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bill".
 *
 * @property integer $id
 * @property integer $type
 * @property string $date
 * @property string $photo
 * @property string $amount
 * @property integer $vehicle_id
 *
 * @property Vehicle $vehicle
 */
class Bill extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bill';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'vehicle_id'], 'integer'],
            [['date'], 'safe'],
            [['photo'], 'image', 'skipOnEmpty' => true],
            [['amount'], 'number'],
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
            'type' => 'Type',
            'date' => 'Date',
            'photo' => 'Photo',
            'amount' => 'Amount [zł]',
            'vehicle_id' => 'Vehicle ID',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            if ($this->photo != null) {
                $this->photo->saveAs('uploads/' . $this->photo->baseName . '.' . $this->photo->extension);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

///<?= $form->field($model, 'type')->dropDownList(['0' => 'Za paliwo', '1' => 'Drobne naprawy', '2' => 'Wieksze naprawy',
//'3' => 'Zakup części', '4' => 'Mandaty', '5' => 'Opłaty drogowe'],
//['prompt' => ''])
    public function getBillType() {
        if ($this->type == 0) {
            return 'Za paliwo';
        }
        if ($this->type == 1) {
            return 'Drobne naprawy';
        }
        if ($this->type == 2) {
            return 'Większe naprawy';
        }
        if ($this->type == 3) {
            return 'Zakup części';
        }
        if ($this->type == 4) {
            return 'Mandaty';
        }
        if ($this->type == 5) {
            return 'Opłaty drogowe';
        }
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
