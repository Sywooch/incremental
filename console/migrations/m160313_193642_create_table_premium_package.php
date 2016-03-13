<?php

use yii\db\Migration;

class m160313_193642_create_table_premium_package extends Migration
{
    public function up()
    {
        $this->createTable('{{%premium_package}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->string(),
            'image' => $this->string(),
            'premiumGained' => $this->integer(),
            'costReal' => $this->double(),
            'costPoints' => $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%premium_package}}');
    }
}
