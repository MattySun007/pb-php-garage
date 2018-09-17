<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Refuel */

$this->title = 'Create Refuel';
$this->params['breadcrumbs'][] = ['label' => 'Refuels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="refuel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
