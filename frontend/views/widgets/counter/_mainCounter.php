<?php
//Displays a counter for our game's points.
//Pass In:
//  game - The game model.

$currentCount = $game->points;
$currentCountIncrement = $game->getPointsPerUpdate();
$secondsBetweenUpdate = 1;
$displayClass = 'counterDisplay';
?>

<div class='jumbotron'>
    <h1 class='counterDisplay'><?=$currentCount?></h1>
    <p class='lead'><span class='counter-increment'><?=$currentCountIncrement?></span> per second</p>
</div>

<?= $this->render('/widgets/counter/_counter-script', [
    'currentCount' => $currentCount,
    'currentCountIncrement' => $currentCountIncrement,
    'secondsBetweenUpdate' => $secondsBetweenUpdate,
    'displayClass' => $displayClass,
]) ?>

