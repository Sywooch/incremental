<?php
//Displays a paypal button for purchasing packages. Redirects to a successful purchase page.
//Pass In:
// packageId - The id for the package we are buying.
// game - The id for the game.

use app\models\PremiumPackage;
$package = PremiumPackage::findOne($packageId);

//returnUrl: The url to return to when the purchase is complete.
//$returnUrl = "http://www.google.com";
$returnUrl = Yii::getAlias("@url") . "/frontend/web/premium-package/thank-you?owner=$game";
?>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="BUR77M4ZYM9BG">
    <input type="hidden" name="lc" value="US">
    <input type="hidden" name="item_name" value="Gems">
    <input type="hidden" name="item_number" value="<?=$packageId?>">
    <input type="hidden" name="amount" value="<?=$package->costReal?>">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="return" value="<?=$returnUrl?>">
    <input type="hidden" name="rm" value="2">
    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

