<?php

use yii\db\Migration;

class m160313_163900_add_urls_to_incrementable extends Migration
{
    public function up()
    {
        $this->addColumn('incrementable', 'urlIcon', $this->string());
        $this->addColumn('incrementable', 'urlIconUnknown', $this->string());
        $this->addColumn('incrementable', 'urlBio', $this->string());
        $this->addColumn('incrementable', 'urlBioUnknown', $this->string());
        $this->addColumn('incrementable', 'urlArt', $this->string());
    }

    public function down()
    {
        $this->dropColumn('incrementable', 'urlIcon');
        $this->dropColumn('incrementable', 'urlIconUnknown');
        $this->dropColumn('incrementable', 'urlBio');
        $this->dropColumn('incrementable', 'urlBioUnknown');
        $this->dropColumn('incrementable', 'urlArt');
    }
}
