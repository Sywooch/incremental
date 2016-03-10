<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "incrementable".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $urlIcon
 * @property string $urlBio
 * @property string $urlArt
 * @property integer $initialCost
 * @property double $growthCost
 * @property integer $initialProduction
 * @property integer $growthProduction
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 */
class Incrementable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'incrementable';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'urlIcon', 'urlBio', 'urlArt', 'initialCost', 'growthCost', 'initialProduction', 'growthProduction', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['description'], 'string'],
            [['initialCost', 'initialProduction', 'growthProduction', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['growthCost'], 'number'],
            [['name', 'urlIcon', 'urlBio', 'urlArt'], 'string', 'max' => 255]
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
            'urlIcon' => 'Url Icon',
            'urlBio' => 'Url Bio',
            'urlArt' => 'Url Art',
            'initialCost' => 'Initial Cost',
            'growthCost' => 'Growth Cost',
            'initialProduction' => 'Initial Production',
            'growthProduction' => 'Growth Production',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
