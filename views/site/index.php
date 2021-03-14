<?php

/* @var $this yii\web\View */
/* @var $form LoggerForm*/

use app\models\forms\LoggerForm;
use yii\helpers\Html;

$this->title = 'Logger';
?>
<div class="site-index">

    <div class="jumbotron">
        <?= Html::errorSummary($form, ['encode' => false]) ?>
    </div>

    <div class="body-content">
        <ul>
            <?php
            foreach (explode(PHP_EOL, $form->getLogFileContent()) as $line){
                echo "<li>$line</li>";
            }
            ?>
        </ul>
    </div>

</div>
