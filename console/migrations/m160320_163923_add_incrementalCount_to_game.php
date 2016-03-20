<?php

use yii\db\Migration;

class m160320_163923_add_incrementalCount_to_game extends Migration
{
    public function up()
    {
        $this->addColumn('game', 'incrementableCount', $this->integer()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('game', 'incrementableCount');
    }
}
