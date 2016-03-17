<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Incrementable;
use yii\data\ActiveDataProvider;

use common\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Game */

$this->title = User::findOne($model->user)->username;
$this->params['breadcrumbs'][] = $this->title;

$model->updatePoints();

//Determine our incrementables.
$dataProvider = new ActiveDataProvider([
        'query' => Incrementable::find(),
    ]);
//Determine if we are the owner.
$isOwner = false;
if(!Yii::$app->user->isGuest)
{
    if($model->user == Yii::$app->user->identity->id)
        $isOwner = true;
}
?>
<div class="game-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= $this->render('/premium-package/_popup') ?>
    
    <?= $this->render('/widgets/counter/_mainCounter', [
        'game' => $model,
    ]) ?>

    <!--CONTROL WIDGET--------------------------------------------------------->
    <div class="portlet solid light col-md-8 col-md-offset-2 col-xs-12">
        <div class="portlet-title tabbable-line">
            <div class="caption">
                <span class="caption-subject bold font-yellow-lemon uppercase">DELETE THIS AND EXPAND TABS</span>
            </div>
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#portlet_tab1" data-toggle="tab">INCREMENTABLES</a>
                </li>
                <li>
                    <a href="#portlet_tab2" data-toggle="tab">ACHIEVEMENTS</a>
                </li>
                <li>
                    <a href="#portlet_tab3" data-toggle="tab">STATISTICS</a>
                </li>
            </ul>
        </div>
        <div class="portlet-body">
            <div class="tab-content">
                <!--INCREMENTABLE TAB-->
                <div class="tab-pane active" id="portlet_tab1">
                    <div class="slimScrollDiv">
                        <div class="scroller" data-initialized="1">
                        <?= $this->render('_tab_incrementables', ['model' => $model, 'incrementableProvider' => $dataProvider, 'userIsOwner' => $isOwner]) ?>
                        </div>
                    </div>
                </div>
                <!--END INCREMENTABLE TAB-->
                <div class="tab-pane" id="portlet_tab2">
                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><div class="scroller" style="height: 200px; overflow: hidden; width: auto;" data-initialized="1">
                        <h4>ACHIEVEMENTS</h4>
                        ACHIEVEMETNS GO HERE
                    </div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; background: rgb(187, 187, 187);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);"></div></div>
                </div>
                <div class="tab-pane" id="portlet_tab3">
                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><div class="scroller" style="height: 200px; overflow: hidden; width: auto;" data-initialized="1">
                        <h4>STATISTICS</h4>
                        STATISTICS GO HERE
                    </div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; background: rgb(187, 187, 187);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);"></div></div>
                </div>
            </div>
        </div>
    </div>
    <!--END CONTROL WIDGET----------------------------------------------------->
    
    <!--
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user',
            'created_at',
            'updated_at',
            'points',
            'lastIncrease',
        ],
    ]) ?>
    -->
    
</div>
