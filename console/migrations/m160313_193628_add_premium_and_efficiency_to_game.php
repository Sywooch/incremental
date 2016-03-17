<?php

use yii\db\Migration;

class m160313_193628_add_premium_and_efficiency_to_game extends Migration
{
    public function up()
    {
        $this->addColumn('game', 'premium', $this->integer()->defaultValue(500));
        $this->addColumn('game', 'efficiency', $this->double()->defaultValue(1.0));
    }

    public function down()
    {
        $this->dropColumn('game', 'premium');
        $this->dropColumn('game', 'efficiency');
    }
}
