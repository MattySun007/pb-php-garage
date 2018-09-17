<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Insurance;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Vehicle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vehicle-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <?php
    //    <?= $form->field($model, 'id')->textInput()
    ?>


    <?= $form->field($model, 'type')->dropDownList([
        'Osobowy' => 'Osobowy',
        'Bus' => 'Bus',
        'Ciezarowka' => 'Ciężarówka',
        'Motocykl' => 'Motocykl',
    ], ['prompt' => '']) ?>


    <?= $form->field($model, 'make')->textInput() ?>

    <?= $form->field($model, 'capacity')->textInput() ?>

    <?= $form->field($model, 'year')->textInput() ?>


    <?php
    if ($model->isNewRecord) {
        $insurances = Insurance::find()->all();
    } else {
        $insurances = Insurance::find()->where(['vehicleid' => $model->id])->all();
    }
    $listData = ArrayHelper::map($insurances, 'id', 'InsuranceName');
    //all above should probably go to the controller?
    echo $form->field($model, 'insurance')->dropDownList($listData, ['prompt' => 'Wybierz polisę ubezpieczniową'])

    ?>

    <?= $form->field($model, 'photo')->fileInput() ?>

    <?= $form->field($model, 'rentcost')->textInput() ?>

    <?= $form->field($model, 'fueltype')->dropDownList(['LPG' => 'LPG', 'Benzyna' => 'Benzyna', 'Diesel' => 'Diesel',],
        ['prompt' => '']) ?>

    <?php

    $owners = \app\models\Owner::find()->all();
    $listData = ArrayHelper::map($owners, 'id', 'OwnerName');
    echo $form->field($model, 'owner_id')->dropDownList($listData, ['prompt' => 'Wybierz właściciela auta'])

    ?>

    <?php

    $garages = \app\models\Garage::find()->all();
    $listData = ArrayHelper::map($garages, 'id', 'GarageName');
    echo $form->field($model, 'garage_id')->dropDownList($listData, ['prompt' => 'Wybierz garaż w którym stoi auto'])

    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
