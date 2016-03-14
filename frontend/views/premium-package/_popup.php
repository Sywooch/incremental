<?php
/* 
 * Displays a popup that contains all the packages available for purchase.
 * We are using the Candy Crush Saga purchase page as a sample.
 */
use app\models\PremiumPackage;
use yii\helpers\Url;

//Include CSS and JS.
$this->registerCssFile(Yii::getAlias("@web") . "/css/components-rounded.min.css");
$this->registerJsFile(Yii::getAlias("@web") . "/js/jquery.bpopup.min.js", ['depends' => [\yii\web\JqueryAsset::className()]]);

$allPackages = PremiumPackage::find()->all();
?>

<!--BUTTON----------------------------------------------------------------->
<a class="btn btn-success" href="#" onclick='$("#packages-popup").bPopup({position: [0, 0]});'>+</a>
<!--END BUTTON------------------------------------------------------------->
<!--POPUP------------------------------------------------------------------>
<div id="packages-popup" class='col-xs-12' style="z-index: 9999; opacity: 0; display: none;">
    <div class="well col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 col-xs-12 inc-popup">
        <!--CLOSE BUTTON-->
        <div class='col-xs-1'><a class="btn btn-default b-close">X</a></div>
        <!--CONTENT-->
        <ul>
            <?php foreach($allPackages as $package) { ?>
            <li style='display:inline;'>
                <div class="portlet light bg-inverse">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject bold font-purple-studio uppercase"><?=$package->name?></span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class='row'>
                            <div class='col-md-6 col-xs-6'>
                                <img src='<?=$package->image?>' class='col-xs-12'/>
                            </div>
                            <div class='col-md-6 col-xs-6'>
                                <h4><?=$package->name?></h4>
                                <p> 
                                    <?=$package->description?>
                                </p>
                                <p>
                                    $<?=round($package->costReal,2)?>
                                </p>
                            </div>
                        </div>
                        <div class='portlet-body'>
                            <a class='btn btn-success col-xs-10 col-xs-offset-1'>Get Rich!</a>
                        </div>
                    </div>
                </div>
            </li>
            <?php } //End foreach($allPackages) ?>
        </ul>
    </div>
</div>
<!--END POPUP-------------------------------------------------------------->