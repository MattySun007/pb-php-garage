<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Service */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-view">

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
            'title',
            'description',
            'date',
            'mileage',
            'cost',
            [
                'value' => $vehicle->getVehicleName(),
                'label' => 'Vehicle',
            ],
            [
                'value' => $model->getServiceName(),
                'label' => 'Type',
            ],
            [
                'value' => $model->getServiceShopName(),
                'label' => 'Servicing shop name',
            ]
        ],
    ]) ?>

    <?php
    if ($model->getUsedParts() != null) {
        echo '<h1>Parts used in this service</h1>';
        foreach ($model->getUsedParts() as $part) {
            $realpart = \app\models\Part::find()->where(['id' => $part])->one();
            echo Html::a('Edit part', ['part/update', 'id' => $realpart->id]);
            echo DetailView::widget([
                'model' => $realpart,
                'attributes' => [
                    'name',
                    'type',
                    'price',
                ],
            ]);
        };
    }
    ?>

</div>