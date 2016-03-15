<?php
use app\models\Game;

/* @var $this yii\web\View */
//Pass In
// model - The current user's game. 'null' if the user is a guest.

$this->title = '10 Billion Bottles Of Beer';

$colorClass = 'red';
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
                <?php if($model == null) { ?>
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
            <div class="portlet-body">
                <?php if($model == null) { ?>
                        Display an ad.
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                <?php } else { ?>
                        Display the game.
                        <br/>
                        <br/>
                        <br/>
                        <br/>
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
                We will display news here.
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
                We will display news here.
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
                Here we will display our about information.
            </div>
        </div>
    </div>
    <!--END ABOUT-------------------------------------------------------------->
    </div>
    
    <div class='row'>
    <!--TOP USERS---------------------------------------------------------------
    Displays the top users.
    -->
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
                        <p>
                            The brewmasters listed below run the most efficient breweries in the dwarfish realm.
                        </p>
                    </div>
                    <div class="tab-pane" id="portlet_tab_2">
                        <p>
                            The brewasters listed below are famed among the dwarfish clans for their vast hoards of beer.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END TOP USERS---------------------------------------------------------->
    </div>
</div>
