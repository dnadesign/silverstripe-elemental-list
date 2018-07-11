<?php

namespace DNADesign\ElementalList\Model;

use DNADesign\Elemental\Models\BaseElement;
use DNADesign\Elemental\Models\ElementalArea;
use DNADesign\Elemental\Extensions\ElementalAreasExtension;

use SilverStripe\Core\Config\Config;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\FieldType\DBField;

class ElementList extends BaseElement
{
    private static $icon = 'font-icon-block-file-list';

    private static $has_one = [
        'Elements' => ElementalArea::class
    ];

    private static $owns = [
        'Elements'
    ];

    private static $cascade_deletes = [
        'Elements'
    ];

    private static $cascade_duplicates = [
        'Elements'
    ];

    private static $extensions = [
        ElementalAreasExtension::class
    ];

    private static $table_name = 'ElementList';

    private static $title = 'Group';

    private static $description = 'Orderable list of elements';

    private static $singular_name = 'list';

    private static $plural_name = 'lists';

    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'List');
    }

    /**
     * @return DBField
     */
    public function getSummary()
    {
        $count = $this->Elements()->Elements()->Count();
        $suffix = $count === 1 ? 'element': 'elements';
        $summary = $this->ListDescription ? DBField::create_field('HTMLText', $this->ListDescription)->Summary(10) . '<br />': '';

        return DBField::create_field('HTMLText', $summary . ' <span class="el-meta">Contains ' . $count . ' ' . $suffix . '</span>');
    }

    /**
     * Retrieve a elemental area relation name which this element owns
     *
     * @return string
     */
    public function getOwnedAreaRelationName()
    {
        $has_one = $this->config()->get('has_one');

        foreach ($has_one as $relationName => $relationClass) {
            if ($relationClass === ElementalArea::class && $relationName !== 'Parent') {
                return $relationName;
            }
        }

        return 'Elements';
    }
}
