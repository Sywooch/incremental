<?php

//Display all incrementables. Allow owners to purchase from this page.
//Pass In:
//  game - Current game we are viewing
//  incrementableProvider - DataProvider holding all incrementables available for purchase.
//  userIsOwner - Is the viewer the current owner of this game? If so, we will enable purchasing.

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Game */

$this->title = "Incrementables";
$this->params['breadcrumbs'][] = ['label' => User::findOne($model->user)->username, 'url' => ['view-game', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;

$model->updatePoints();
?>
<div class="game-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= $this->render('/widgets/counter/_mainCounter', [
        'game' => $model,
    ]) ?>
    
    <?php if($userIsOwner) { ?>
    <a href="#" onclick="$.purchaseTapUpgrade(<?=$model->id?>, '<?= Yii::$app->request->baseUrl ?>',$('.counter').data('incrementalcounter'))" class='btn btn-default'>
        +<span class='clicker-production'><?=$model->getPointsPerClick()?></span>
        (<span class="clicker-cost"><?=$model->getCostToUpgradeClick()?></span>)
    </a>
    <a href="#" onclick="$.performTap(<?=$model->id?>, '<?= Yii::$app->request->baseUrl ?>',$('.counter').data('incrementalcounter'))" class='btn btn-default'>
        +<span class='clicker-production'><?=$model->getPointsPerClick()?></span>
    </a>
    <?php } //End if($userIsOwner) ?>

    <?php foreach($incrementableProvider->models as $incrementable) { ?>
        <?= $this->render('_incrementableButton', [
            'game' => $model,
            'incrementable' => $incrementable,
            'isOwner' => $userIsOwner,
        ]) ?>
    <?php } //End foreach($incrementableProvider->models) ?>
    
</div>
