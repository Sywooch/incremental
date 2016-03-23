<?php
use app\models\Game;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

/* @var $this yii\web\View */
//Pass In
// model - The current user's game. 'null' if the user is a guest.

$this->title = '10 Billion Bottles Of Beer';

$colorClass = 'red-haze';
?>
<div class="site-index">

    <div class='row'>
    <!--TAG LINE----------------------------------------------------------------
    If the user is a guest, display game advertisement and a 'Get Brewin' button.
    Otherwise, display the user's current point count.
    -->
    <div class='col-xs-12'>
        <div class="portlet box <?=$colorClass?>">
            <div class="portlet-title">
                <div class="caption">
                10 Billion Bottles of Beer
                </div>
            </div>
            <div class="portlet-body text-center">
                <?php if(!$model) { ?>
                    <p class="lead">Brew beer, unite the dwarves, and conquer the world!</p>
                    <a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get Brewin'!</a>
                <?php } else { ?>
                    <p class='lead'>
                        Your brewery has <?= $this->render('/widgets/counter/_simpleCounter', ['game' => $model,]) ?> bottles of beer on the wall!
                    </p>
                <?php } //End if($model == null) ?>
            </div>
        </div>
    </div>
    <!--END TAG LINE----------------------------------------------------------->
    </div>
    
    <div class='row'>
    <!--BREWERY SCREEN----------------------------------------------------------
    If we are logged in, this panel displays the actual game screen with dwarves 
    running across the screen. Otherwise, a little ad is displayed.
    -->
    <div class='col-md-8 col-xs-12'>
        <div class="portlet box <?=$colorClass?>">
            <div class="portlet-title">
                <div class="caption">
                Brewery
                </div>
            </div>
            <div class="portlet-body text-center">
                <?php if(!$model) { ?>
                        <?= Html::a('Signup!', 'site/signup', ['class' => 'btn btn-success']) ?>
                <?php } else { ?>
                        <?= Html::a('Play!', 'game/view-world', ['class' => 'btn btn-success']) ?>
                <?php } //End if($model == null) ?>
            </div>
        </div>
    </div>
    <!--END BREWERY SCREEN----------------------------------------------------->
    
    <!--PREMIUM AD--------------------------------------------------------------
    Displays an advertisement for our premium currency.
    -->
    <div class='col-md-4 col-xs-12'>
        <div class="portlet box <?=$colorClass?>">
            <div class="portlet-title">
                <div class="caption">
                Get Rich!
                </div>
            </div>
            <div class="portlet-body text-center">
                <p class="lead">
                    In the dwarfish realms, beer is money!
                </p>
                <p class="text-center">
                    <?= $this->render('/premium-package/_popup', [
                        'buttonContent' => "<a class='btn btn-success'>Get Rich!</a>",
                        'game' => Yii::$app->user->identity->id,
                    ])?>
                </p>
            </div>
        </div>
    </div>
    <!--END PREMIUM AD--------------------------------------------------------->
    </div>
    
    <div class='row'>
    <!--BULLETIN BOARD----------------------------------------------------------
    Displays any recent messages.
    -->
    <div class='col-md-4 col-xs-12'>
        <div class="portlet box <?=$colorClass?>">
            <div class="portlet-title">
                <div class="caption">
                News
                </div>
            </div>
            <div class="portlet-body text-center">
                <p class="lead">
                Thank you for testing beta 10b3! Be sure to share with your friends!
                </p>
            </div>
        </div>
    </div>
    <!--END BULLETIN BOARD----------------------------------------------------->
    
    <!--ABOUT-------------------------------------------------------------------
    Displays information about the game, bryantmakesprog, and 1GAM.
    -->
    <div class='col-md-8 col-xs-12'>
        <div class="portlet box <?=$colorClass?>">
            <div class="portlet-title">
                <div class="caption">
                About
                </div>
            </div>
            <div class="portlet-body">
                <p class='lead'>
                    <i>Ten Billion Bottles of Beer</i> is a simple game. Brew Beer. 
                    Recruit Dwarves. Brew more Beer. Despite the simplicity, 
                    however, 10b3 marks a special moment for me. I recently accepted
                    an internship at a web development company. With this new job,
                    I haven't had time to keep up with my traditional game 
                    development. 10b3 is different in that it is completely coded
                    in PHP and Javascript. This allowed me to hone my web development
                    skills while still keeping up with a hobby that I love. I know
                    it may not be the prettiest, but I'm rather proud of 10b3 
                    simply because its the first step in a new, strange, and (hopefully)
                    long career in web development!
                </p>
            </div>
        </div>
    </div>
    <!--END ABOUT-------------------------------------------------------------->
    </div>
    
    <div class='row'>
    <!--TOP USERS---------------------------------------------------------------
    Displays the top users.
    -->
    <?php
        $pointProvider = new ActiveDataProvider([
            'query' => Game::find()->limit(20),
            'sort'=> ['defaultOrder' => ['points'=>SORT_DESC]]
        ]);
        $productionProvider = new ActiveDataProvider([
            'query' => Game::find()->limit(20),
            'sort'=> ['defaultOrder' => ['lastIncrease'=>SORT_DESC]]
        ]);
    ?>
    <div class='col-xs-12'>
        <div class="portlet box <?=$colorClass?>">
            <div class="portlet-title">
                <div class="caption">
                Top Users
                </div>
                <ul class="nav nav-tabs">
                    <li class="">
                        <a href="#portlet_tab_2" data-toggle="tab" aria-expanded="false">Beers</a>
                    </li>
                    <li class="active">
                        <a href="#portlet_tab_1" data-toggle="tab" aria-expanded="true">Production</a>
                    </li>
                </ul>
            </div>
            <div class="portlet-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="portlet_tab_1">
                        <p class="lead">
                            The brewmasters listed below run the most efficient breweries in the dwarfish realm.
                        </p>
                        <?php foreach($productionProvider->models as $productionModel) { ?>
                        <?= Html::a($productionModel->getUsername(), ['game/view-game', 'id'=>$productionModel->id]) ?>
                        :
                        <?= $productionModel->lastIncrease ?>
                        <?= $this->render('/widgets/icon/bottle', ['type'=>'basic', 'size'=>1.5]) ?> / second
                        <br/>
                        <?php } //End foreach($productionProvider->models ?>
                    </div>
                    <div class="tab-pane" id="portlet_tab_2">
                        <p class="lead">
                            The brewasters listed below are famed among the dwarfish clans for their vast hoards of beer.
                        </p>
                        <?php foreach($pointProvider->models as $productionModel) { ?>
                        <?= Html::a($productionModel->getUsername(), ['game/view-game', 'id'=>$productionModel->id]) ?>
                        :
                        <?= $productionModel->points ?>
                        <?= $this->render('/widgets/icon/bottle', ['type'=>'basic', 'size'=>1.5]) ?>
                        <br/>
                        <?php } //End foreach($productionProvider->models ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END TOP USERS---------------------------------------------------------->
    </div>
</div>
