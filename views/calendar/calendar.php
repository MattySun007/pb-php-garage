<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Calendar';
$this->params['breadcrumbs'][] = $this->title;
$baseUrl = Yii::$app->homeUrl;

?>

<h1><?= Html::encode($this->title) ?></h1>

<?= yii2fullcalendar\yii2fullcalendar::widget(
    [
        'events' => $events,
        'options' => [
            'lang' => 'en',
        ],
    ]);
?>
