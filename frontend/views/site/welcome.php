<?php
use app\models\Game;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = '10 Billion Bottles Of Beer';

$colorClass = 'red-haze';
?>
<div class="site-index">

    <div class="col-md-12">
        <?= Html::a('Subscribe', 'site/signup/', ['class' => 'btn btn-success']) ?>
    </div>
    
</div>
