<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Insurance */

$this->title = 'Create Insurance';
$this->params['breadcrumbs'][] = ['label' => 'Insurances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="insurance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
