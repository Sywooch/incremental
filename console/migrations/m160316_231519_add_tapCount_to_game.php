<?php

use yii\db\Migration;

class m160316_231519_add_tapCount_to_game extends Migration
{
    public function up()
    {
        $this->addColumn('game', 'tapCount', $this->integer()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('game', 'tapCount');
    }
}
