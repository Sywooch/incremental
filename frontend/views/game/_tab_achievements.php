<?php

//Display all incrementables. Allow owners to purchase from this page.
//Pass In:
//  model - Current game we are viewing
//  achievementProvider - DataProvider holding all incrementables available for purchase.
//  userIsOwner - Is the viewer the current owner of this game? If so, we will enable purchasing.

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Incrementable;

use common\models\User;

$model->updatePoints();

?>

<div>

    <?php foreach($achievementProvider->models as $achievement) { ?>
        <?= $this->render('_achievementButton', [
            'game' => $model,
            'achievement' => $achievement,
            'isOwner' => $userIsOwner,
        ]) ?>
    <?php } //End foreach($incrementableProvider->models) ?>
    
</div>
