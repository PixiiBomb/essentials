<?php

namespace PixiiBomb\Essentials\Widgets;

use PixiiBomb\Essentials\Traits\HasActiveItems;
use PixiiBomb\Essentials\Traits\HasItems;
use PixiiBomb\Essentials\Widgets\Items\AccordionItem;

class Accordion extends Widget
{
    use HasItems, HasActiveItems;

    #region Constructor
    /**
     * Create a new component instance.
     */
    public function __construct(array $items = [], array $activeIndexes = [])
    {
        parent::__construct();
        $this->filterType = AccordionItem::class;
        $this->setItems($items);
        $this->setActiveIndexes($activeIndexes);
    }
    #endregion
}
