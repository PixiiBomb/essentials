<?php

namespace PixiiBomb\Essentials\Widgets;

use PixiiBomb\Essentials\Traits\HasItems;
use PixiiBomb\Essentials\Traits\HasActiveItem;
use PixiiBomb\Essentials\Widgets\Items\CarouselItem;

class Progress extends Widget
{
    use HasItems, HasActiveItem;

    #region Constructor
    /**
     * Create a new widget instance.
     */
    public function __construct(array $items = [], int $activeItem = -1)
    {
        parent::__construct();
        $this->filterType = CarouselItem::class;
        $this->setItems($items);
        $this->setActiveIndex($activeItem);
    }
    #endregion
}
