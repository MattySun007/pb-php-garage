<?php

namespace yii\jui;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\Vehicle */
/* @var $form ActiveForm */
?>
<div class="vehicle-rent">

    <?php $form = ActiveForm::begin(); ?>
    <br><br><br><br><br>

    <?= $form->field($model, 'startdate')->widget(\yii\jui\DatePicker::classname(), [])->label('First day of rent') ?>
    <?= $form->field($model, 'enddate')->widget(\yii\jui\DatePicker::classname(), [])->label('Last day of rent') ?>

    <div class="form-group">
        <?= Html::submitButton('Generate agreement', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- vehicle-rent -->
