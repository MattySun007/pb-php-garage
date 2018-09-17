<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use scotthuangzl\googlechart\GoogleChart;

define('VEHICLEPICWIDTH', 400);

/* @var $this yii\web\View */
/* @var $model app\models\Vehicle */

$this->title = $model->make;
$this->params['breadcrumbs'][] = ['label' => 'Vehicles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vehicle-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
    <?php
    if($model->photo != null)
        echo Html::img('@web/uploads/' . $model->photo, ['width' => VEHICLEPICWIDTH])
    ?>
    </p>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
    if ($model->rentcost != 0) {
        echo Html::a('Rent this vehicle', ['rent', 'id' => $model->id], ['class' => 'btn btn-primary']);
    }
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'make',
            'capacity',
            'year',
            'rentcost',
            'fueltype',
            [
            'format' => 'raw',
            'value' => Html::a($model->getGarageName(), ['garage/view', 'id' => $model->garage_id]),
//            'value' => $model->getGarageName(),
            'label' => 'Garaż',
            ],
            [
            'format' => 'raw',
            'value' => Html::a($model->getOwnerName(), ['owner/view', 'id' => $model->owner_id]),
            //'value' => $model->getOwnerName(),
            'label' => 'Właściciel',
            ],
        ],
    ]) ?>

    <?php
    if ($model->insurance != null) {
        echo '<h1>Current insurance</h1>';
        echo Html::a('Edit insurance', ['insurance/update', 'id' => $insurance->id]);
        echo DetailView::widget([
            'model' => $insurance,
            'attributes' => [
                'id',
                'price',
                'startson',
                'endson',
                'company',
                'insurancenumber',
                [
                    'value' => $model->endingsoon(),
                    'label' => 'Ending',
                ],
            ],
        ]);
    } else {
        echo Html::a('Add insurance', ['insurance/create', 'vehicleid' => $model->id]);
    }
    ?>
    <p>
        <?php
        echo '<h1>Fuel related costs</h1>';
        if ($model->fueltype == "Diesel") {
            echo 'Total cost of used Diesel fuel: ' . $model->totalDieselCost() . 'zł<br>';
        } else {
            if ($model->fueltype == "Benzyna" || $model->fueltype == "LPG") {
                echo 'Total cost of used gasoline: ' . $model->totalGasolineCost() . 'zł<br>';
            }
        }
        /* if a car's LPG powered, then display benzyna (gasoline) first and LPG second, cause LPG powered cars run on both fuels
            I should have probably set fueltype as an int and 0=diesel, 1=benzyna etc as storing that as a string doesn't really make any sence - not only it'll use much more DB storage, but internationalizing this won't be easy
        */

        if ($model->fueltype == "LPG") {
            echo 'Total cost of used LPG: ' . $model->totalLPGCost() . 'zł<br>';
            //display LPG vs gasoline stats if there were both LPG and gasoline refuels
            if($model->totalGasolineCost() != 0 && $model->totalLPGCost() != 0) {
                echo GoogleChart::widget(array(
                    'visualization' => 'PieChart',
                    'data' => [
                        ['Rodzaj paliwa', 'Koszt'],
                        ['LPG', $model->totalLPGCost()],
                        ['Benzyna', $model->totalGasolineCost()]
                    ],
                    'options' => array('title' => 'Stosunek kosztu benzyny do LPG')
                ));
            }
        }
        ?>
    </p>

    <?php
    if ($model->getBills() != null) {
        echo '<h1>Bills and invoices related with this vehicle</h1>';
        foreach ($model->getBills() as $bill) {
            $realbill = \app\models\Bill::find()->where(['id' => $bill])->one();
            echo Html::a('Edit bill', ['bill/update', 'id' => $realbill->id]);
            echo '<br>';
            echo Html::a('Bill details', ['bill/view', 'id' => $realbill->id]);

            echo DetailView::widget([
                'model' => $realbill,
                'attributes' => [
                    'date',
                    'amount',
                    'BillType',
                    [
                            'value' => $realbill->photo ? Html::img('@web/uploads/' . $realbill->photo, ['width' => '300']) : 'Brak',
                            'label' => 'Photo',
                            'format' => 'raw',
                    ]
//                    'price',
                ],
            ]);
        };
    }
    ?>

</div>
