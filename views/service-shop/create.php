<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ServiceShop */

$this->title = 'Create Service Shop';
$this->params['breadcrumbs'][] = ['label' => 'Service Shops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-shop-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
