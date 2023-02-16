<?php

namespace DNADesign\ElementalList\Model;

use DNADesign\Elemental\Models\BaseElement;
use DNADesign\Elemental\Models\ElementalArea;
use DNADesign\Elemental\Extensions\ElementalAreasExtension;
use SilverStripe\ORM\FieldType\DBField;

/**
 * @property int $ElementsID
 * @method ElementalArea Elements()
 */
class ElementList extends BaseElement
{
    private static string $icon = 'font-icon-block-file-list';

    private static array $has_one = [
        'Elements' => ElementalArea::class
    ];

    private static array $owns = [
        'Elements'
    ];

    private static array $cascade_deletes = [
        'Elements'
    ];

    private static array $cascade_duplicates = [
        'Elements'
    ];

    private static array $extensions = [
        ElementalAreasExtension::class
    ];

    private static string $table_name = 'ElementList';

    private static string $title = 'Group';

    private static string $description = 'Orderable list of elements';

    private static string $singular_name = 'list';

    private static string $plural_name = 'lists';

    public function getType(): string
    {
        return _t(__CLASS__ . '.BlockType', 'List');
    }

    /**
     * @return DBField
     */
    public function getSummary(): string
    {
        $count = $this->Elements()->Elements()->Count();
        $suffix = $count === 1 ? 'element': 'elements';

        return 'Contains ' . $count . ' ' . $suffix;
    }

    /**
     * Retrieve a elemental area relation name which this element owns
     *
     * @return string
     */
    public function getOwnedAreaRelationName(): string
    {
        $has_one = $this->config()->get('has_one');

        foreach ($has_one as $relationName => $relationClass) {
            if ($relationClass === ElementalArea::class && $relationName !== 'Parent') {
                return $relationName;
            }
        }

        return 'Elements';
    }

    public function inlineEditable(): bool
    {
        return false;
    }
}
