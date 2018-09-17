<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Refuel */

$this->title = 'Update Refuel: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Refuels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="refuel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
