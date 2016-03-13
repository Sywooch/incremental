<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "premium_product".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property integer $costPremium
 * @property integer $pointsGained
 * @property double $efficiencyGained
 */
class PremiumProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'premium_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['costPremium', 'pointsGained'], 'integer'],
            [['efficiencyGained'], 'number'],
            [['name', 'description', 'image'], 'string', 'max' => 255]
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
            'image' => 'Image',
            'costPremium' => 'Cost Premium',
            'pointsGained' => 'Points Gained',
            'efficiencyGained' => 'Efficiency Gained',
        ];
    }
}
