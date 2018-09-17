<?php

namespace yii\jui;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Service */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->dropDownList([
        '0' => 'Przegląd techniczny',
        '1' => 'Wymiana oleju',
        '2' => 'Wymiana świec',
        '3' => 'Zawieszenie',
        '4' => 'Inne',
    ], ['prompt' => '']) ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'date')->widget(\yii\jui\DatePicker::classname(), []) ?>

    <?= $form->field($model, 'mileage')->textInput() ?>

    <?= $form->field($model, 'cost')->textInput() ?>

    <?php

    $vehicles = \app\models\Vehicle::find()->all();
    $listData = ArrayHelper::map($vehicles, 'id', 'make');
    echo $form->field($model, 'vehicle')->dropDownList($listData, ['prompt' => 'Wybierz samochód'])

    ?>

    <?php

    $parts = \app\models\Part::find()->all();
    $listData = ArrayHelper::map($parts, 'id', 'name');
    echo $form->field($partsModel, 'part_id')->checkBoxList($listData, ['prompt' => 'Wybierz użyte części w naprawie'])

    ?>

    <?php

    $serviceShops = \app\models\ServiceShop::find()->all();
    $listData = ArrayHelper::map($serviceShops, 'id', 'name');
    echo $form->field($model, 'service_shop_id')->dropDownList($listData, ['prompt' => 'Wybierz warsztat dokonujący naprawy'])

    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
