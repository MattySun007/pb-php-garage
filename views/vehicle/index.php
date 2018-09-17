<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VehicleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vehicles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vehicle-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Vehicle', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'type',
            'make',
            'capacity',
            'year',
            /* 'insurance',
             [
                 'value' => $searchModel->insurance[1]->id,
                 'label' => 'Koszt',
             ],*/
            'insurance',
            // 'photo',
            'rentcost',
            'GarageName',
            'OwnerName',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
