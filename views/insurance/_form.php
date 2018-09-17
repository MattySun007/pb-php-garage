<?php
namespace yii\jui;

use app\models\Vehicle;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Insurance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="insurance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company')->textInput() ?>

    <?= $form->field($model, 'startson')->widget(\yii\jui\DatePicker::classname(), []) ?>

    <?= $form->field($model, 'endson')->widget(\yii\jui\DatePicker::classname(), []) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'pricenextyear')->textInput() ?>

    <?= $form->field($model, 'insurancenumber')->textInput() ?>

    <?php
    if ($model->vehicleid != null) { //if linked from, for ex. vehicle insurance creation, then dont display vehicle selector
    } else {
        $vehicles = Vehicle::find()->all();
        $listData = ArrayHelper::map($vehicles, 'id', 'VehicleName');

        echo $form->field($model, 'vehicleid')->dropDownList($listData, ['prompt' => 'Wybierz ubezpieczony samochód']);
    }

    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
