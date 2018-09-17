<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "vehicle".
 *
 * @property integer $id
 * @property string $type
 * @property string $make
 * @property integer $capacity
 * @property integer $year
 * @property integer $insurance
 * @property integer $photo
 * @property integer $rentcost
 *
 * @property Refuel $refuel
 * @property Repair $repair
 * @property Insurance $id0
 */
class Vehicle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vehicle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'make', 'fueltype'], 'string'],
            [['capacity', 'year', 'insurance', 'rentcost', 'garage_id', 'owner_id'], 'integer'],
            [['photo'], 'image', 'skipOnEmpty' => true],

            // [['id'], 'exist', 'skipOnError' => false, 'targetClass' => Insurance::className(), 'targetAttribute' => ['id' => 'id']],
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
            'make' => 'Make',
            'capacity' => 'Capacity [cm3]',
            'year' => 'Year',
            'insurance' => 'Insurance ID',
            'photo' => 'Photo',
            'rentcost' => 'Rent cost (per day) (zł)',
            'fueltype' => 'Fuel type',
            'garage_id' => 'Garage ID',
            'owner_id' => 'Owner ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefuel()
    {
        return $this->hasOne(Refuel::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepair()
    {
        return $this->hasOne(Repair::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Insurance::className(), ['insurance' => 'id']);
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

    public function endingsoon()
    {
        $insurance = Insurance::find()->where(['id' => $this->insurance])->one();
        $today = new \DateTime(date('Y-m-d'));
        $endingdate = \DateTime::createFromFormat('Y-m-d', $insurance->endson);
        $difference = $endingdate->diff($today)->format("%a"); //BAD - even when the insurance's already ended it still will display a + value
        if ($difference <= 14) {
            $endssoon = "Ends in $difference days, REMEMBER TO BUY A NEW INSURANCE AS SOON AS POSSIBLE!"; //returning a string sucks, but it was faster for displaying this message instead of messing around with displaying that in gridview
        } else {
            $endssoon = "Ends in $difference days.";
        }
        return $endssoon;
    }

    public function getVehicleName()
    {
        return $this->make . ' ' . $this->year;
    }

    public function getBills()
    {
        $billsArray = [];
        $bills = Bill::find()->where(['vehicle_id' => $this->id])->all();
        foreach ($bills as $bill) {
            array_push($billsArray, $bill->id);
        }
        return $billsArray;
    }

    public function getGarageName() {
        $garage = Garage::find()->where(['id' => $this->garage_id])->one();
        if ($garage === null) {
            return 'Unset';
        }
        return $garage->address . ' ' . $garage->house_number . ' ' . $garage->city;
    }

    public function getOwnerName() {
        $owner = Owner::find()->where(['id' => $this->owner_id])->one();
        if ($owner === null) {
            return 'Owner unset';
        }
        return $owner->first_name . ' ' . $owner->last_name;
    }

    public function rentalcost($startdate, $enddate)
    {
        $startdateconverted = \DateTime::createFromFormat('F j, Y', $startdate);
        $enddateconverted = \DateTime::createFromFormat('F j, Y', $enddate);
        $difference = $enddateconverted->diff($startdateconverted)->format("%a");
        $difference++; //cause we should bill starting on the first day
        $totalcost = $difference * $this->rentcost;
        return $totalcost;
    }

    public function totalFuelCost()
    {
        $sum = 0;
        $refuels = Refuel::find()->where(['vehicle' => $this->id])->all();
        foreach ($refuels as $refuel) {
            $sum += $refuel->cost;
        }
        return $sum;
    }

    public function totalLPGCost()
    {
        $sum = 0;
        $refuels = Refuel::find()->where(['vehicle' => $this->id, 'type' => 'LPG'])->all();
        foreach ($refuels as $refuel) {
            $sum += $refuel->cost;
        }
        return $sum;
    }

    public function totalDieselCost()
    {
        $sum = 0;
        $refuels = Refuel::find()->where(['vehicle' => $this->id, 'type' => 'Diesel'])->all();
        foreach ($refuels as $refuel) {
            $sum += $refuel->cost;
        }
        return $sum;
    }

    public function totalGasolineCost()
    {
        $sum = 0;
        $refuels = Refuel::find()->where(['vehicle' => $this->id, 'type' => 'Benzyna'])->all();
        foreach ($refuels as $refuel) {
            $sum += $refuel->cost;
        }
        return $sum;
    }

}
