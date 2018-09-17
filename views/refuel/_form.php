<?php

namespace yii\jui;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\Refuel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="refuel-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'type')->dropDownList(['LPG' => 'LPG', 'Benzyna' => 'Benzyna', 'Diesel' => 'Diesel',],
        ['prompt' => '']) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'cost')->textInput() ?>

    <?= $form->field($model, 'date')->widget(\yii\jui\DatePicker::classname(), []) ?>


    <?php

    $vehicles = \app\models\Vehicle::find()->all();
    $listData = ArrayHelper::map($vehicles, 'id', 'make');
    echo $form->field($model, 'vehicle')->dropDownList($listData, ['prompt' => 'Wybierz tankowany samochód'])

    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
