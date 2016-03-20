<?php

use yii\db\Migration;

class m160320_191031_create_table_achievementConnections extends Migration
{
    public function up()
    {
        $this->createTable('{{%achievement_connections}}', [
            'id' => $this->primaryKey(),
            'owner' => $this->integer()->notNull(),
            'achievement' => $this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%achievement_connections}}');
    }
}
