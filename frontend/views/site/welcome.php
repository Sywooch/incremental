<?php
use app\models\Game;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = '10 Billion Bottles Of Beer';

$colorClass = 'red-haze';
?>

<!--CALL TO ACTION------------------------------------------------------------->
<div class='col-md-4 col-xs-12'>
    <div class="portlet box <?=$colorClass?>">
        <div class="portlet-title">
            <div class="caption">
            Get Rich!
            </div>
        </div>
        <div class="portlet-body text-center">
            <p class="lead">
                In the dwarfish realms, beer is money!
            </p>
            <p class="text-center">
                <?= $this->render('/premium-package/_popup', [
                    'buttonContent' => "<a class='btn btn-success'>Get Rich!</a>",
                    'game' => Yii::$app->user->identity->id,
                ])?>
            </p>
        </div>
    </div>
</div>
<!--END CALL TO ACTION--------------------------------------------------------->


<div class="site-index">

    <div class="col-md-12">
        <?= Html::a('Subscribe', 'site/signup/', ['class' => 'btn btn-success']) ?>
    </div>
    
</div>
