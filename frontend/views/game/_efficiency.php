<?php
/* 
 * Displays a popup asking the user if they'd like to upgrade their efficiency.
 * 
 * Pass In: 
 *  buttonContent - How our button should display.
 *  game - Game that will receive the premium.
 * 
 * Uses Classes:
 *  premium - Any value listing the amount of premium currency we currently hold.
 *  efficiency - Any value listing the current level of efficiency.
 */
use app\models\PremiumPackage;
use yii\helpers\Url;
use yii\web\View;

//Default button.
if(!isset($buttonContent))
    $buttonContent = "<a class='btn btn-success' href='#'>Efficiency</a>";

//Include JS.
//$this->registerCssFile(Yii::getAlias("@web") . "/css/components-rounded.min.css");
$this->registerJsFile(Yii::getAlias("@web") . "/js/jquery.bpopup.min.js", ['depends' => [\yii\web\JqueryAsset::className()]]);

?>

<!--BUTTON----------------------------------------------------------------->
<span onclick='$("#efficiency-popup").bPopup({position: [0,0]});'><?=$buttonContent?></span>
<!--END BUTTON------------------------------------------------------------->
<!--POPUP------------------------------------------------------------------>
<div id="efficiency-popup" class='col-xs-12' style="z-index: 9999; opacity: 0; display: none;">
    <div class="well col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 col-xs-12 inc-popup">
        <!--CLOSE BUTTON-->
        <div class='col-xs-1'><a class="btn btn-default b-close">X</a></div>
        <!--CONTENT-->
        <ul>
            <div class="jumbotron text-left">
                <h2>
                    I'm giving her all she's got...
                </h2>
                <p class='lead'>
                    ...your head brewer shouts to you. "Perhaps a little treat would 
                    convince my dwarves to work a little faster, though. One thousand 
                    bottles of dwarven reserve might do the trick."
                </p>
                <p class='lead'>
                    Upgrade your brewery's efficiency by 20% for 1,000 
                    <?=$this->render('/widgets/icon/bottle', ['type' => 'premium']) ?>?
                </p>
                <div class='row'>
                    <a onclick='$.purchaseEfficiency(<?=$game?>, "<?= Yii::$app->request->baseUrl ?>")' class='btn btn-primary col-md-6 col-md-offset-3 col-xs-10 col-xs-offset-1'>Upgrade</a>
                </div>
            </div>
        </ul>
    </div>
</div>
<!--END POPUP-------------------------------------------------------------->

<!--SCRIPTING-------------------------------------------------------------->
<?php $script = "
    (function($) {
        $.updatePremiumDisplay = function(value) {
            $('.premium').text(value);
        };
        $.updateEfficiencyDisplay = function(value) {
            $('.efficiency').text(value);
        };
        $.updatePointsPerSecondDisplay = function(value) {
            $('.counter-increment').text(value);
        };
        $.purchaseEfficiency = function(gameId, baseurl, incrementalCounter) {
            $.ajax({
            type: 'POST',
            url: baseurl + '/game/purchase-efficiency-upgrade',
            data: {game:gameId},
            dataType: 'json', // Set the data type so jQuery can parse it for you
            success: function (data) {
                //message: 'success', 'failure', 'null'
                var message = data[0];
                console.log(message);
                if(message == 'success')
                {
                    //Update display info.
                    var newEfficiency = data[2];
                    var newPremium = data[1];
                    var newIncrement = data[3];
                    $.updatePremiumDisplay(newPremium);
                    $.updateEfficiencyDisplay(newEfficiency);
                    $.updatePointsPerSecondDisplay(newIncrement);
                    location.reload(true);
                }
                else
                {
                    //Insufficient funds. Display popup.
                    $('#packages-popup').bPopup({position: [0,0]});
                }
            },
            error: function (data) {
                alert('Purchase attempt met server-side issues. If this error occurs, something is very wrong. Please notify administration.');
            }
        });
    };
    })(jQuery);" ;
$this->registerJs($script, View::POS_READY);
?>
<!--END SCRIPTING---------------------------------------------------------->