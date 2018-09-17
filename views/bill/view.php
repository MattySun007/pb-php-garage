<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
define('VEHICLEPICWIDTH', 750);

/* @var $this yii\web\View */
/* @var $model app\models\Bill */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bills', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bill-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if($model->photo != null)
        echo Html::img('@web/uploads/' . $model->photo, ['width' => VEHICLEPICWIDTH])
    ?>
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
            'BillType',
            'date',
            'photo',
            'amount',
            [
                'value' => $vehicle->getVehicleName(),
//            'value' => $model->getGarageName(),
                'label' => 'Vehicle',
            ],
        ],
    ]) ?>
    <?= Html::a('Details of the car associated with this bill', ['vehicle/view', 'id' => $vehicle->id]); ?>
    <br>
    <?= Html::a('Edit the vehicle associated with this bill', ['vehicle/update', 'id' => $vehicle->id]); ?>


</div>
