<?php

//Display all incrementables. Allow owners to purchase from this page.
//Pass In:
//  model - Current game we are viewing
//  incrementableProvider - DataProvider holding all incrementables available for purchase.
//  userIsOwner - Is the viewer the current owner of this game? If so, we will enable purchasing.

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Incrementable;

use common\models\User;

$model->updatePoints();

?>

<div>

    <?php foreach($incrementableProvider->models as $incrementable) { ?>
        <?= $this->render('_incrementableButton', [
            'game' => $model,
            'incrementable' => $incrementable,
            'isOwner' => $userIsOwner,
        ]) ?>
    <?php } //End foreach($incrementableProvider->models) ?>
    
</div>
