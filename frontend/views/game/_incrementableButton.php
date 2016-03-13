<?php
//Display a view/purchase button for /game/view-incrementables
//Pass In:
//  game - The model for our game.
//  incrementable - The model for our incrementable. 
//  isOwner - Is the current user the owner?

use yii\helpers\Html;

$level = $game->getLevelOfIncrementable($incrementable->id);
$pointsPerUpdate = $incrementable->getProductionForLevel($level);
$costToUpgrade = $incrementable->getCostForLevel($level);

$this->registerCssFile(Yii::getAlias("@web") . "/css/components-rounded.min.css");
$this->registerJsFile(Yii::getAlias("@web") . "/js/jquery.bpopup.min.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::getAlias("@web") . "/js/incremental-controller.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
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
                Lv.<span class="level-<?=$incrementable->id?>" data-counter="counterup" data-value="12,5"><?= $level ?></span>
            </div>
            <div class="desc"><span class='production-<?=$incrementable->id?>'><?= $pointsPerUpdate ?></span>PPS</div>
        </div>
        <a class="more" href="#" onclick='$("#<?=$incrementable->id?>-popup").bPopup({position: [0, 0]});'> Details...
            <i class="m-icon-swapright m-icon-white"></i>
        </a>
    </div>
    <!--END BUTTON------------------------------------------------------------->
    
    <!--POPUP------------------------------------------------------------------>
    <div id="<?=$incrementable->id?>-popup" class='col-xs-12' style="z-index: 9999; opacity: 0; display: none;">
        <div class="well col-md-6 col-md-offset-3 col-xs-12">
            <div class="row">
                <div class='col-xs-11'><h3><?= $level > 0 ? $incrementable->name : "???" ?></h3></div>
                <div class='col-xs-1'><a class="btn btn-default b-close">X</a></div>
            </div>
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
                    IMAGE HERE
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <p>Lv.<span class='level-<?=$incrementable->id?>'><?= $level ?></span></p>
                    <p><span class='production-<?=$incrementable->id?>'><?= $level > 0 ? $pointsPerUpdate : "???" ?></span>PPS</p>
                    <?php if($isOwner) { ?>
                    <p>Cost To <?= $level > 0 ? "Upgrade" : "Purchase" ?>: <span class='cost-<?=$incrementable->id?>'><?= $costToUpgrade ?></span>Points</p>
                    <?php } //End if($isOwner) ?>
                </div>
            </div>
            <div class=row">
                <a class="btn btn-success" onclick="$.purchaseIncrementable(<?=$incrementable->id?>, <?=$game->id?>, '<?= Yii::$app->request->baseUrl ?>', $('.counter').data('incrementalcounter'))"><?= $level > 0 ? "Upgrade" : "Purchase" ?></a>
            </div>
        </div>
    </div>
    <?php if(!$isOwner) { ?>
        <?php } //End if($isOwner) ?>
    <!--END POPUP-------------------------------------------------------------->
</div>

