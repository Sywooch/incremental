<?php
//Displays a counter for our game's points.
//Pass In:
//  game - The game model.

$currentCount = $game->points;
$currentCountIncrement = $game->getPointsPerUpdate();
$secondsBetweenUpdate = 1;
$displayClass = 'gameCounterDisplay';
$currentClickIncrement = $game->getPointsPerClick();
?>

<div class='row'>
    <div class='col-md-6 col-xs-12'>
        <h1>
            <?= $this->render('/widgets/icon/bottle', ['type'=>'basic', 'size'=>1.5]) ?>
            <span class='gameCounterDisplay' style='vertical-align:bottom;'><?=$currentCount?></span>
        </h1>
        <p class='lead'><span class='counter-increment'><?=$currentCountIncrement?></span> per second</p>
    </div>
    <div class='col-md-6 col-xs-12 text-right'>
        <h1>
            <span class='premium' style='vertical-align:bottom;'><?=$game->premium?></span>
            <?= $this->render('/widgets/icon/bottle', ['type'=>'premium', 'size'=>1.5]) ?>
        </h1>
        <!--Premium Purchase Button -->
        <?php if(!Yii::$app->user->isGuest) { ?>
            <p class='lead'>
                <?= $this->render('/premium-package/_popup', [
                    'buttonContent' => '<a href="#">Get More!</a>',
                    'game' => Yii::$app->user->identity->id,
                ])?>
            </p>
        <?php } //End if(!isGuest) ?>
    </div>
</div>

<?= $this->render('/widgets/counter/_counter-script', [
    'currentCount' => $currentCount,
    'currentCountIncrement' => $currentCountIncrement,
    'secondsBetweenUpdate' => $secondsBetweenUpdate,
    'displayClass' => $displayClass,
    'currentClickIncrement' => $currentClickIncrement,
]) ?>

