<?php

namespace app\controllers;

use app\models\Insurance;
use app\models\Service;

class CalendarController extends \yii\web\Controller
{
    public function actionCalendar()
    {
        $insurances = Insurance::find()->where([
            //'valid' => true,
        ])->all();

        $inspections = Service::find()->where([
            'type' => 0,
        ])->all();

        $oilchanges = Service::find()->where([
            'type' => 1,
        ])->all();

        $events = [];
        foreach ($insurances as $insurance) {
            $events[] = $insurance->convertToEvent();
        }

        foreach ($inspections as $inspection) {
            $events[] = $inspection->convertToEvent();
        }

        foreach ($oilchanges as $oilchange) {
            $events[] = $oilchange->convertToEvent();
        }

        return $this->render('calendar', [
            'events' => $events
        ]);
    }

}
