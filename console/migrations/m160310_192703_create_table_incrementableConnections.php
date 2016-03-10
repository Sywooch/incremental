<?php

use yii\db\Migration;

class m160310_192703_create_table_incrementableConnections extends Migration
{
    public function up()
    {
        $this->createTable('{{%incrementable_connections}}', [
            'id' => $this->primaryKey(),
            //User Info
            'owner' => $this->integer()->notNull(),
            //Incrementable Info
            'incrementable' => $this->integer()->notNull(),
            'level' => $this->integer()->notNull()->defaultValue(0),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%incrementable_connections}}');
    }
}
