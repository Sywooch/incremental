<?php
//Displays a counter for our game's points.
//Pass In:
//  game - The game model.

$currentCount = $game->points;
$currentCountIncrement = $game->getPointsPerUpdate();
$secondsBetweenUpdate = 1;
$displayClass = 'simple-counter';
$currentClickIncrement = $game->getPointsPerClick();
?>

<span class='simple-counter'><?=$currentCount?></span>

<?= $this->render('/widgets/counter/_counter-script', [
    'currentCount' => $currentCount,
    'currentCountIncrement' => $currentCountIncrement,
    'secondsBetweenUpdate' => $secondsBetweenUpdate,
    'displayClass' => $displayClass,
    'currentClickIncrement' => $currentClickIncrement,
]) ?>

