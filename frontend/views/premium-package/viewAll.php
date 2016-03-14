<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\Game;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerCssFile(Yii::getAlias("@web") . "/css/components-rounded.min.css");
$this->registerJsFile(Yii::getAlias("@web") . "/js/jquery.bpopup.min.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::getAlias("@web") . "/js/incremental-controller.js", ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->title = 'Packages';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="premium-package-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php foreach($dataProvider->models as $model) { ?>
    <div class="col-md-8 col-md-offset-2 col-xs-12">
    <!--BUTTON----------------------------------------------------------------->
    <div class="dashboard-stat purple-plum">
        <div class="visual">
            <i class="fa fa-bar-chart-o"></i>
        </div>
        <div class='details-left'>
            
            <div class='details-icon'>
                <img src="<?=$model->image?>"/>
            </div>
            
            <div class='number'>
                <span class="name-<?=$model->id?>"><?= $model->name ?></span>
            </div>
        </div>
        <div class="details">
            <div class="number">
                $<span class="level-<?=$model->id?>" data-counter="counterup" data-value="12,5"><?=round($model->costReal,2)?></span>
            </div>
        </div>
        <a class="more" href="#" onclick='$("#<?=$model->id?>-popup").bPopup({position: [0, 0]});'> Details...
            <i class="m-icon-swapright m-icon-white"></i>
        </a>
    </div>
    <!--END BUTTON------------------------------------------------------------->
    
    <!--POPUP------------------------------------------------------------------>
    <div id="<?=$model->id?>-popup" class='col-xs-12' style="z-index: 9999; opacity: 0; display: none;">
        <div class="well col-md-6 col-md-offset-3 col-xs-12 inc-popup">
            <div class="row">
                <div class='col-xs-11'><h3><span class="name-<?=$model->id?>"><?= $model->name ?></span></h3></div>
                <div class='col-xs-1'><a class="btn btn-default b-close">X</a></div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <img src="<?= $model->image ?>" class="col-xs-6 col-xs-offset-3 image-bio-<?=$model->id?>"/>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <p>Lv.<span class='level-<?=$model->id?>'></span></p>
                </div>
            </div>
            <div class=row">
                <a class="btn btn-success" onclick="$.purchaseIncrementable(<?=$model->id?>, <?=$model->id?>, '<?= Yii::$app->request->baseUrl ?>', $('.counter').data('incrementalcounter'))"></a>
            </div>
        </div>
    </div>
    <!--END POPUP-------------------------------------------------------------->
    </div>
    <?php } //End foreach($dataProvider->models) ?>

</div>
