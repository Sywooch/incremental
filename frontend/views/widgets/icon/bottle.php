<?php
/*
 * Displays an icon for our brew. By default, it matches the height of the text.
 * Pass In:
 *  type - The type of bottle. Either a string or an achievemnt model.
 *  size - The multiplier for the size. text-height * size = icon size. Default = 1.0
 */

use app\models\Achievement;

//Include CSS and JS.
$this->registerCssFile(Yii::getAlias("@web") . "/css/tooltipster.css");
$this->registerJsFile(Yii::getAlias("@web") . "/js/jquery.tooltipster.js", ['depends' => [\yii\web\JqueryAsset::className()]]);

if(!isset($size))
    $size = 1.5;

$id = uniqid();

//Determine our bottles information.
$image = "";
$name = "";
$description = "";
$flavor = "";
switch($type)
{
    case 'basic':
        //TODO add a tooltip.
        $image = "/img/brews/brown-glass.png";
        $name = "Dwarven Brew";
        $description = "A mild ale of dwarven make. It is used as a currency throughout the realm.";
        break;
    case 'premium':
        $image = "/img/brews/purple-to-pink.png";
        $name = "Redbeard Reserve";
        $description = "Worth its weight in gold, this rich rum has been aged longer than most dwarves have lived.";
        break;
    default:
        //Grab info from the achievement.
        $image = $type->image;
        $name = $type->name;
        $description = $type->description;
        $flavor = $type->flavor;
        break;
}

?>

<!--Bottle Widget-->
<img class='tooltip-<?=$id?>' src="<?=Yii::getAlias("@web") . $image?>" style="height:<?=$size?>em;" />
<!--End Bottle Widget-->

<!--Tooltip Script-->
<?php
$tooltipContent = "";
$tooltipContent .= '<div>';
$tooltipContent .= '<div class="tooltip-name-common">' . $name . "</div>";
$tooltipContent .= '<div class="tooltip-description">' . $description . "</div>";
if($flavor != "")
    $tooltipContent .= '<div class="tooltip-flavor">"' . $flavor . '"' . "</div>";
$tooltipContent .= "</div>";

$script = "
    $(document).ready(function() {
        $('.tooltip-$id').tooltipster({
            content: $('$tooltipContent')
        });
    });
";
$this->registerJs($script, \yii\web\View::POS_READY);
?>
<!--End Tooltip Script-->

