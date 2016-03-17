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

<div class='col-xs-12 row'>
    <div class='col-md-6 col-xs-12'>
        <h1 class='gameCounterDisplay'><?=$currentCount?></h1>
        <p class='lead'><span class='counter-increment'><?=$currentCountIncrement?></span> per second</p>
    </div>
    <div class='col-md-6 col-xs-12 text-right'>
        <h2><?=$game->premium?> PREMIUM</h2>
    </div>
</div>

<?= $this->render('/widgets/counter/_counter-script', [
    'currentCount' => $currentCount,
    'currentCountIncrement' => $currentCountIncrement,
    'secondsBetweenUpdate' => $secondsBetweenUpdate,
    'displayClass' => $displayClass,
    'currentClickIncrement' => $currentClickIncrement,
]) ?>

