<?php
/*
 * Displays an icon for our brew. By default, it matches the height of the text.
 * Pass In:
 *  type - The type of bottle.
 *  size - The multiplier for the size. text-height * size = icon size. Default = 1.0
 */

if(!isset($size))
    $size = 1.5;

//Determine which image to use.
$image = "";
switch($type)
{
    case 'basic':
        //TODO add a tooltip.
        $image = "/img/brews/brown-glass.png";
        break;
    case 'premium':
        $image = "/img/brews/purple-to-pink.png";
        break;
    default:
        //TODO Add image found in achievement model.
        $image = "/img/brews/thick-white.png";
        break;
}

?>

<!--Bottle Widget-->
<img src="<?=Yii::getAlias("@web") . $image?>" style="height:<?=$size?>em;" />
<!--End Bottle Widget-->

