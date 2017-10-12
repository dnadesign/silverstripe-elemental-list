<?php

namespace DNADesign\ElementalList\Tests;

use DNADesign\ElementalList\Model\ElementList;
use SilverStripe\Dev\SapphireTest;

class ElementListTest extends SapphireTest
{
    public function testGetRelations()
    {
        $list = ElementList::create();

        $this->assertEquals(['Elements'], $list->getElementalRelations());
    }

    public function testGetCmsFields()
    {

    }

    public function testForTemplate()
    {

    }
}
