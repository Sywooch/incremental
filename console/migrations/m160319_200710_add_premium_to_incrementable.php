<?php

use yii\db\Migration;

class m160319_200710_add_premium_to_incrementable extends Migration
{
    public function up()
    {
        $this->addColumn('incrementable', 'premiumCost', $this->integer()->defaultValue(0));
        $this->addColumn('incrementable', 'active', $this->boolean()->defaultValue(1));
    }

    public function down()
    {
        $this->dropColumn('incrementable', 'premiumCost');
        $this->dropColumn('incrementable', 'active');
    }
}
