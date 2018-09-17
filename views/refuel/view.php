<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Refuel */

$this->title = $model->vehicle;
$this->params['breadcrumbs'][] = ['label' => 'Refuels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="refuel-view">

    <h1><?= Html::encode($this->title) ?></h1>

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'amount',
            'cost',
            'date',
            [
                'value' => $vehicle->getVehicleName(),
                'label' => 'Fueled vehicle',
            ],
            [
                'value' => $model->getUnitCost(),
                'label' => 'Cost per litre (zł)',
            ],
        ],
    ]) ?>
    <?= Html::a('Go to the refueled vehicle details', ['vehicle/view', 'id' => $vehicle->id]); ?>
</div>
