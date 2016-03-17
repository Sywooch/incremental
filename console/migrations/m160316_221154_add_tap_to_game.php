<?php

use yii\db\Migration;

class m160316_221154_add_tap_to_game extends Migration
{
    public function up()
    {
        $this->addColumn('game', 'tap', $this->integer()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('game', 'tap');
    }
}
