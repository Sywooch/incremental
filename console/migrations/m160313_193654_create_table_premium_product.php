<?php

use yii\db\Migration;

class m160313_193654_create_table_premium_product extends Migration
{
    public function up()
    {
        $this->createTable('{{%premium_product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->string(),
            'image' => $this->string(),
            'costPremium' => $this->integer(),
            'pointsGained' => $this->integer(),
            'efficiencyGained' => $this->double(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%premium_product}}');
    }
}
