<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "premium_package".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property integer $premiumGained
 * @property double $costReal
 * @property integer $costPoints
 */
class PremiumPackage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'premium_package';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['premiumGained', 'costPoints'], 'integer'],
            [['costReal'], 'number'],
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
            'premiumGained' => 'Premium Gained',
            'costReal' => 'Cost Real',
            'costPoints' => 'Cost Points',
        ];
    }
}
