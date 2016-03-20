<?php
//Display a view/purchase button for /game/view-incrementables
//Pass In:
//  game - The model for our game.
//  achievement - The model for our incrementable. 
//  isOwner - Is the current user the owner?

use yii\helpers\Html;

$achieved = $game->meetsAchievementRequirements($achievement->id);

//$this->registerCssFile(Yii::getAlias("@web") . "/css/components-rounded.min.css");
?>
<?php if($achieved || $isOwner) { ?>
<div class="col-md-10 col-md-offset-1 col-xs-12">
    <!--BUTTON----------------------------------------------------------------->
    <div class="dashboard-stat purple-plum">
        <div class="visual">
            <i class="fa fa-bar-chart-o"></i>
        </div>
        <div class='details-left'>
            <div class='number'>
                <?php if($achieved) { ?>
                <?= $this->render('/widgets/icon/bottle', ['type'=>$achievement, 'size'=>1.5]) ?>
                <?php } else { ?>
                ? IMG
                <?php } ?>
                <span class="name-<?=$achievement->id?>"><?= $achieved ? $achievement->name : "???" ?></span>
            </div>
        </div>
        <div class="details">
            <div class="number">
                
            </div>
            <div class="desc">
                
            </div>
        </div>
    </div>
    <!--END BUTTON------------------------------------------------------------->
    <!--SPACING---------------------------------------------------------------->
    <display></display>
    <!--END SPACING------------------------------------------------------------>
</div>
<?php } //End if($achieved || $isOwner) ?>

