<?php

namespace app\models;

use Yii;

use app\models\IncrementableConnections;
use app\models\Incrementable;

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
            [['user', 'created_at', 'updated_at', 'points', 'lastIncrease'], 'integer']
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
        $allIncrementables = IncrementableConnections::find()->where(['owner' => Yii::$app->user->identity->id])->all();
        foreach($allIncrementables as $connection)
        {
            $incrementable = Incrementable::findOne($connection->incrementable);
            $pointIncrease += $incrementable->getProductionForLevel($connection->level);
        }
        return $pointIncrease;
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
        $cost = $incrementable->getCostForLevel($currentLevel);
        if($this->points >= $cost)
        {
            $this->points -= $cost;
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
        else
            return false;
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
}
