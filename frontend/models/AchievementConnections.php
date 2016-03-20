<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "achievement_connections".
 *
 * @property integer $id
 * @property integer $owner
 * @property integer $achivement
 */
class AchievementConnections extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'achievement_connections';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['owner', 'achievement'], 'required'],
            [['owner', 'achievement'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'owner' => 'Owner',
            'achievement' => 'Achievement',
        ];
    }
}
