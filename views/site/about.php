<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
$counter = array(range(0, 10));
$someArray = array('1', '2', '3', '4', '5', '6', '7');

?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>
    <p>
        <?php
        foreach ($someArray as $xx) {
            echo $xx;
        }

        foreach ($counter as $item) {
            $item++;
        }
        ?>
    </p>


    <code><?= __FILE__ ?></code>
</div>
