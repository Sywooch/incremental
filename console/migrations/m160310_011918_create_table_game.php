<?php

use yii\db\Migration;

class m160310_011918_create_table_game extends Migration
{
    public function up()
    {
        $this->createTable('{{%game}}', [
            'id' => $this->primaryKey(),
            //User Info
            'user' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            //Mechanics
            'points' => $this->bigInteger()->unsigned()->notNull()->defaultValue(0),
            'lastIncrease' => $this->bigInteger()->unsigned()->notNull()->defaultValue(0),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%game}}');
    }
}
