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
$premiumCostToUpgrade = $incrementable->getPremiumCostForLevel($level);

$this->registerCssFile(Yii::getAlias("@web") . "/css/components-rounded.min.css");
$this->registerJsFile(Yii::getAlias("@web") . "/js/jquery.bpopup.min.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::getAlias("@web") . "/js/incremental-controller.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<?php if($incrementable->active || ($level > 0)) { ?>
<div class="col-md-10 col-md-offset-1 col-xs-12">
    <!--BUTTON----------------------------------------------------------------->
    <div class="dashboard-stat purple-plum">
        <div class="visual">
            <i class="fa fa-bar-chart-o"></i>
        </div>
        <div class='details-left'>
            <div class='number'>
                <img src="<?=$incrementable->urlIcon?>"/>
                <span class="name-<?=$incrementable->id?>"><?= $level > 0 ? $incrementable->name : "???" ?></span>
            </div>
        </div>
        <div class="details">
            <div class="number">
                Lv.<span class="level-<?=$incrementable->id?>" data-counter="counterup" data-value="12,5"><?= $level ?></span>
            </div>
            <div class="desc">
                <span class='production-<?=$incrementable->id?>'><?= $pointsPerUpdate ?></span>
                <?= $this->render('/widgets/icon/bottle', ['type'=>'basic', 'size'=>1.5]) ?>
                / second
            </div>
        </div>
        <a class="more" onclick='$("#<?=$incrementable->id?>-popup").bPopup({position: [0, 0]});'> Details...
            <i class="m-icon-swapright m-icon-white"></i>
        </a>
    </div>
    <!--END BUTTON------------------------------------------------------------->
    
    <!--POPUP------------------------------------------------------------------>
    <display></display>
    <display id="<?=$incrementable->id?>-popup" class='col-xs-12' style="z-index: 9999; opacity: 0; display: none;">
        <div class="well col-md-6 col-md-offset-3 col-xs-12 inc-popup">
            <div class="row">
                <div class='col-xs-11'><h3><span class="name-<?=$incrementable->id?>"><?= $level > 0 ? $incrementable->name : "???" ?></span></h3></div>
                <div class='col-xs-1'><a class="btn btn-default b-close">X</a></div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <img src="<?= $level > 0 ? $incrementable->urlBio : $incrementable->urlBioUnknown ?>" class="col-md-6 col-md-offset-3 col-xs-10 col-xs-offset-1 image-bio-<?=$incrementable->id?>"/>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <p>Lv.<span class='level-<?=$incrementable->id?>'><?= $level ?></span></p>
                    <p>
                        Produces: 
                        <span class='production-<?=$incrementable->id?>'><?= $level > 0 ? $pointsPerUpdate : "???" ?></span>
                        <?= $this->render('/widgets/icon/bottle', ['type'=>'basic', 'size'=>1.5]) ?> / second
                    </p>
                    <?php if($isOwner && $incrementable->active) { ?>
                    <p>
                        <?php if($incrementable->premiumCost <= 0) { ?>
                        Cost To <?= $level > 0 ? "Upgrade" : "Purchase" ?>: 
                        <span class='cost-<?=$incrementable->id?>'><?= $costToUpgrade ?></span>
                        <?= $this->render('/widgets/icon/bottle', ['type'=>'basic', 'size'=>1.5]) ?>
                        <?php } else { ?>
                        Cost To <?= $level > 0 ? "Upgrade" : "Purchase" ?>: 
                        <span class='cost-<?=$incrementable->id?>'><?= $premiumCostToUpgrade ?></span>
                        <?= $this->render('/widgets/icon/bottle', ['type'=>'premium', 'size'=>1.5]) ?>
                        <?php } //End if-else($incrementable->premiumCost <= 0) ?>
                    </p>
                    <?php } //End if($isOwner) ?>
                </div>
            </div>
            <div class=row">
                <?php if($isOwner && $incrementable->active) { ?>
                <a class="btn btn-success" onclick="$.purchaseIncrementable(<?=$incrementable->id?>, <?=$game->id?>, '<?= Yii::$app->request->baseUrl ?>', $('.counter').data('incrementalcounter'))"><?= $level > 0 ? "Upgrade" : "Purchase" ?></a>
                <?php } else if(!$incrementable->active) { ?>
                <p>This dwarfish clan has moved to a new mountain home. Making contact is impossible.</p>
                <?php } ?>
            </div>
        </div>
    </display>
    <?php if(!$isOwner) { ?>
        <?php } //End if($isOwner) ?>
    <!--END POPUP-------------------------------------------------------------->
</div>

<?php } //End if($active || ($level > 0)) ?>

