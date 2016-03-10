<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "incrementable_connections".
 *
 * @property integer $id
 * @property integer $owner
 * @property integer $incrementable
 * @property integer $level
 */
class IncrementableConnections extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'incrementable_connections';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['owner', 'incrementable'], 'required'],
            [['owner', 'incrementable', 'level'], 'integer']
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
            'incrementable' => 'Incrementable',
            'level' => 'Level',
        ];
    }
}
