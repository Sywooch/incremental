<?php
//Display a view/purchase button for /game/view-incrementables
//Pass In:
//  game - The model for our game.
//  incrementable - The model for our incrementable. 
//  isOwner - Is the current user the owner?

$level = $game->getLevelOfIncrementable($incrementable->id);
$pointsPerUpdate = $incrementable->getProductionForLevel($level);
$costToUpgrade = $incrementable->getCostForLevel($level);

$this->registerCssFile("css/components-rounded.min.css");
$this->registerJsFile(Yii::getAlias("@web") . "/js/jquery.bpopup.min.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="col-md-8 col-md-offset-2 col-xs-12">
    <!--BUTTON----------------------------------------------------------------->
    <div class="dashboard-stat purple-plum">
        <div class="visual">
            <i class="fa fa-bar-chart-o"></i>
        </div>
        <div class='details-left'>
            <div class='number'>
                <?= $level > 0 ? $incrementable->name : "???" ?>
            </div>
        </div>
        <div class="details">
            <div class="number">
                Lv.<span data-counter="counterup" data-value="12,5"><?= $level ?></span>
            </div>
            <div class="desc"><?= $pointsPerUpdate ?>PPS</div>
        </div>
        <a class="more" href="#" onclick='$("#<?=$incrementable->id?>-popup").bPopup({position: [0, 0]});'> Details...
            <i class="m-icon-swapright m-icon-white"></i>
        </a>
    </div>
    <!--END BUTTON------------------------------------------------------------->
    
    <!--POPUP------------------------------------------------------------------>
    <div id="<?=$incrementable->id?>-popup" class='well' style="z-index: 9999; opacity: 0; display: none;">
        <div class="row-fluid">
        <div col-xs-9><?= $level > 0 ? $incrementable->name : "???" ?></div>
        <div col-xs-2><a class="btn btn-default b-close">X</a></div>
        </div>
        If you can't get it up use<br>bPopup
    </div>
    <?php if(!$isOwner) { ?>
        <?php } //End if($isOwner) ?>
    <!--END POPUP-------------------------------------------------------------->
</div>

