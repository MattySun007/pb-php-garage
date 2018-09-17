<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Bill */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bill-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'type')->dropDownList(['0' => 'Za paliwo', '1' => 'Drobne naprawy', '2' => 'Wieksze naprawy',
        '3' => 'Zakup części', '4' => 'Mandaty', '5' => 'Opłaty drogowe'],
        ['prompt' => '']) ?>

    <?= $form->field($model, 'date')->widget(\yii\jui\DatePicker::classname(), []) ?>

    <?= $form->field($model, 'photo')->fileInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?php

    $vehicles = \app\models\Vehicle::find()->all();
    $listData = ArrayHelper::map($vehicles, 'id', 'make');
    echo $form->field($model, 'vehicle_id')->dropDownList($listData, ['prompt' => 'Wybierz samochód'])

    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
