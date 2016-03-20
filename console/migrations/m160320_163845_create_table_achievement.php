<?php

use yii\db\Migration;

class m160320_163845_create_table_achievement extends Migration
{
    public function up()
    {
        $this->createTable('{{%achievement}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->text(),
            'flavor' => $this->string(),
            'stats' => $this->string(),
            'image' => $this->string(),
            'incrementable1' => $this->integer()->defaultValue(0),
            'incrementable2' => $this->integer()->defaultValue(0),
            'incrementable3' => $this->integer()->defaultValue(0),
            'value1' => $this->integer()->defaultValue(0),
            'value2' => $this->integer()->defaultValue(0),
            'value3' => $this->integer()->defaultValue(0),
            'usesPercentage' => $this->boolean()->defaultValue(1),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%achievement}}');
    }
}
