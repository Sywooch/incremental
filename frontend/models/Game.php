<?php

namespace app\models;

use Yii;

use app\models\IncrementableConnections;
use app\models\Incrementable;

use app\models\PremiumPackage;
use Omnipay\Omnipay;
use app\models\PremiumProduct;

/**
 * This is the model class for table "game".
 *
 * @property integer $id
 * @property integer $user
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $points
 * @property string $lastIncrease
 */
class Game extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'created_at', 'updated_at'], 'required'],
            [['user', 'created_at', 'updated_at', 'points', 'lastIncrease', 'premium', 'tap'], 'integer'],
            [['efficiency'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user' => 'User',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'points' => 'Points',
            'lastIncrease' => 'Last Increase',
        ];
    }
    
    //Update our points.
    //  secondsInInterval - Indicates how many seconds are in a single interval.
    //      EG: $secondsInInterval = 60 => Update once per minute.
    public function updatePoints($secondsInInterval = 1)
    {
        //Perform any banked taps.
        $this->performTaps();
        //Calculate how many updates to perform.
        $date = new \DateTime();
        $secondsPassed = $date->getTimestamp() - $this->updated_at;
        $numUpdates = floor($secondsPassed / $secondsInInterval);
        //Calculate our point increase.
        $pointsPerUpdate = $this->getPointsPerUpdate();
        $pointIncrease = $pointsPerUpdate * $numUpdates;
        //Update our model.
        $this->points += $pointIncrease;
        $this->lastIncrease = $pointsPerUpdate;
        $this->updated_at = $this->updated_at + ($numUpdates * $secondsInInterval);
        $this->save();
    }
    
    //Calculate our points per update interval.
    public function getPointsPerUpdate()
    {
        $pointIncrease = 0;
        //Get all incrementables.
        $allIncrementables = IncrementableConnections::find()->where(['owner' => $this->user])->all();
        foreach($allIncrementables as $connection)
        {
            $incrementable = Incrementable::findOne($connection->incrementable);
            $pointIncrease += $incrementable->getProductionForLevel($connection->level);
        }
        return floor($pointIncrease * $this->efficiency);
    }
    
    //Calculate our points per click.
    public function getPointsPerClick()
    {
        if($this->tap == 0)
            return 1;
        return 100 * pow(10, $this->tap - 1);
    }
    
    //Calculate cost to upgrade tap.
    public function getCostToUpgradeClick()
    {
        return 50000 * pow(10, $this->tap - 1);
    }
    
    //Upgrade our tap. Returns true if we had sufficient funds.
    public function upgradeTap()
    {
        $costToUpgrade = $this->getCostToUpgradeClick();
        if($this->points >= $costToUpgrade)
        {
            $this->points -= $costToUpgrade;
            $this->tap += 1;
            $this->save();
            return true;
        }
        else
            return false;
    }
    
    //Perform a tap.
    public function performTaps()
    {
        $numTaps = $this->tapCount;
        $tapIncrement = $this->getPointsPerClick();
        $this->points += $tapIncrement * $numTaps;
        $this->tapCount = 0;
        $this->save();
    }
    
    //Purchase an incrementable based on the current user level.
    //  Returns true if we had sufficient funds. Returns false if the purchase was denied due to insufficient funds.
    public function purchaseIncrementable($incrementableId)
    {
        $incrementable = Incrementable::findOne($incrementableId);
        //Calculate the current level of the given incrementable. If no connection exists, we don't own this incrementable.
        $currentLevel = 0;
        $connection = IncrementableConnections::find()->where(['owner' => $this->user, 'incrementable' => $incrementableId])->one();
        if($connection)
            $currentLevel = $connection->level;
        //Determine if we can buy this upgrade.
        $premiumPurchase = $incrementable->premiumCost > 0;
        $cost = 0;
        if($premiumPurchase)
            $cost = $incrementable->getPremiumCostForLevel($currentLevel);
        else
            $cost = $incrementable->getCostForLevel($currentLevel);
        if(!$premiumPurchase && ($this->points >= $cost))
        {
            $this->points -= $cost;
            $this->save();
        }
        else if($premiumPurchase && ($this->premium >= $cost))
        {
            $this->premium -= $cost;
            $this->save();
        }
        else
        {
            return false;
        }
        //Create our new connection (if needed).
        if($connection)
            $connection->level++;
        else {
            $connection = new IncrementableConnections();
            $connection->owner = $this->user;
            $connection->incrementable = $incrementableId;
            $connection->level = 1;
        }
        $connection->save();
        return true;
    }
    
    //Get the level of the given incrementable for this game.
    public function getLevelOfIncrementable($incrementableId)
    {
        $connection = IncrementableConnections::find()->where(['incrementable' => $incrementableId, 'owner' => $this->user])->one();
        if($connection)
            return $connection->level;
        else
            return 0;
    }
    
    //Purchase a premium product. Returns true on a successful purchase.
    public function purchasePremiumProduct($productId)
    {
        $product = PremiumProduct::findOne($productId);
        //Check if product exists.
        if(!$product)
            return false;
        //Attempt purchase.
        if($this->premium >= $product->costPremium)
        {
            $this->premium -= $product->costPremium;
            $this->efficiency += $product->efficiencyGained;
            $this->points += $product->pointsGained;
            $this->save();
            return true;
        }
        else
            return false;
    }
    
    //Purchase a premium package. Returns true on a successful purchase.
    public function purchasePremiumPackage($packageId)
    {
        $package = PremiumPackage::findOne($packageId);
        //Check if package exists.
        if(!$package)
            return false;
        //Check if package costs points.
        if($package->costPoints > 0)
        {
            //Attempt purchase.
            if($this->points >= $package->costPoints)
            {
                $this->points -= $package->costPoints;
                $this->premium += $package->premiumGained;
                $this->save();
                return true;
            }
            else
                return false;
        }
        else if($package->costReal > 0)
        {
            
        }
    }
    
    //Post a paypal payment. Returns true if purchase was successful.
    public function postPayment($cardInfo, $package)
    {
        //Setup Gateway.
        $gateway = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AcGvb0wlfd1_ixOO_wkVKK_DDuBtMnMHE2NRNwHKl_Qqnmjol44yAG77c8FTNVwM8ydYPspKfSkcPsVL',
                'EM6sUWx-X5Rbul18aHJCy5byq9jTVS3j5yeRqtrSdXulOVevz1QzMBLsc4kJAj1oPm0wuJbA63odOac2'
            )
        );
        //Setup Card.
        $card = new \PayPal\Api\CreditCard();
        $card->setType($cardInfo['type'])
                ->setNumber($cardInfo['number'])
                ->setExpireMonth($cardInfo['expireMonth'])
                ->setExpireYear($cardInfo['expireYear'])
                ->setCvv2($cardInfo['cvv2'])
                ->setFirstName($cardInfo['firstName'])
                ->setLastName($cardInfo['lastName']);
        //Setup Funding Instrument
        $fi = new \PayPal\Api\FundingInstrument();
        $fi->setCreditCard($card);
        //Setup Payer
        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod("credit_card")
                ->setFundingInstruments([$fi]);
        //Setup Item
        $item = new \PayPal\Api\Item();
        $item->setName($package->name)
                ->setDescription($package->description)
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setTax(0.0)
                ->setPrice($package->costReal);
        $itemList = new \PayPal\Api\ItemList();
        $itemList->setItems([$item]);
        //Setup Order Details
        $details = new \PayPal\Api\Details();
        $details->setShipping(0.0)
                ->setTax(0.0)
                ->setSubtotal($package->costReal);
        //Setup Charge Amount
        $amount = new \PayPal\Api\Amount();
        $amount->setCurrency('USD')
                ->setTotal($package->costReal)
                ->setDetails($details);
        //Setup Transaction
        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription("BryantMakesPrograms.com")
                ->setInvoiceNumber(uniqid());
        //Setup Payment
        $payment = new \PayPal\Api\Payment();
        $payment->setIntent("sale")
                ->setPayer($payer)
                ->setTransactions([$transaction]);
        //Setup Request
        $request = clone $payment;
        //Attempt Payment
        try {
            $result = $payment->create($gateway);
        } catch (Exception $ex) {
            echo "====ERROR CREATING PAYMENT<\br>";
            return false;
        }
        echo $result->getState();
        return true;
    }
}
