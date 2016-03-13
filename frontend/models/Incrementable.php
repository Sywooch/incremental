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
 * @property integer $initialProduction
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
            [['name', 'description', 'urlIcon', 'urlIconUnknown', 'urlBio', 'urlBioUnknown', 'urlArt', 'initialCost', 'initialProduction', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['description'], 'string'],
            [['initialCost', 'initialProduction', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name', 'urlIcon', 'urlBio', 'urlArt', 'urlIconUnknown', 'urlBioUnknown'], 'string', 'max' => 255]
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
            'initialProduction' => 'Initial Production',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
    
    public function getCostForLevel($level, $precision = 0)
    {
        if($level == 0)
            return $this->initialCost;
        return round((.86 * $this->initialCost) * exp(.1385 * $level), $precision);
    }
    
    public function getProductionForLevel($level, $precision = 0)
    {
        if($level == 0)
            return 0;
        if($level == 1)
            return $this->initialProduction;
        return round($level * $this->initialProduction, $precision);
    }
}
