<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "achievement".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $flavor
 * @property string $stats
 * @property string $image
 * @property integer $incrementable1
 * @property integer $incrementable2
 * @property integer $incrementable3
 * @property integer $value1
 * @property integer $value2
 * @property integer $value3
 * @property integer $usesPercentage
 */
class Achievement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'achievement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['incrementable1', 'incrementable2', 'incrementable3', 'value1', 'value2', 'value3', 'usesPercentage'], 'integer'],
            [['name', 'flavor', 'stats', 'image'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'flavor' => 'Flavor',
            'stats' => 'Stats',
            'image' => 'Image',
            'incrementable1' => 'Incrementable1',
            'incrementable2' => 'Incrementable2',
            'incrementable3' => 'Incrementable3',
            'value1' => 'Value1',
            'value2' => 'Value2',
            'value3' => 'Value3',
            'usesPercentage' => 'Uses Percentage',
        ];
    }
}
