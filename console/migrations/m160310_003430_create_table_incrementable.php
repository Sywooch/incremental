<?php

use yii\db\Migration;

class m160310_003430_create_table_incrementable extends Migration
{
    public function up()
    {
        $this->createTable('{{%incrementable}}', [
            'id' => $this->primaryKey(),
            //Description
            'name' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'urlIcon' => $this->string()->notNull(),
            'urlBio' => $this->string()->notNull(),
            'urlArt' => $this->string()->notNull(),
            //Mechanics
            'initialCost' => $this->integer()->notNull(),
            'growthCost' => $this->double()->notNull(),
            'initialProduction' => $this->integer()->notNull(),
            'growthProduction' => $this->integer()->notNull(),
            //Log
            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%incrementable}}');
    }
}
