<?php

use yii\db\Migration;

class m160313_163900_add_urls_to_incrementable extends Migration
{
    public function up()
    {
        $this->addColumn('incrementable', 'urlIcon', $this->integer());
        $this->addColumn('incrementable', 'urlIconUnknown', $this->integer());
        $this->addColumn('incrementable', 'urlBio', $this->integer());
        $this->addColumn('incrementable', 'urlBioUnknown', $this->integer());
        $this->addColumn('incrementable', 'urlArt', $this->integer());
    }

    public function down()
    {
        $this->removeColumn('incrementable', 'urlIcon');
        $this->removeColumn('incrementable', 'urlIconUnknown');
        $this->removeColumn('incrementable', 'urlBio');
        $this->removeColumn('incrementable', 'urlBioUnknown');
        $this->removeColumn('incrementable', 'urlArt');
    }
}
