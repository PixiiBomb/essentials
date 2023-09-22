<?php

namespace PixiiBomb\Essentials\View\Components;

use PixiiBomb\Essentials\View\Items\AccordionItem;

class Accordion extends PixiiComponent
{
    /**
     * Each element in the $showOnRender array represents an index from the $items array that should be displayed when
     * the server renders the component to the browser.
     * @var array
     */
    protected array $showIndexes = [];

    public function getItems(): array
    {
        return $this->items;
    }

    public function getShowIndexes(): array {return $this->showIndexes; }

    public function setItems(array $items = []): Accordion
    {
        $this->items = filterArray(AccordionItem::class, $items);
        return $this;
    }

    /**
     * Set the index values that should be displayed when the server renders the component to the browser.
     * @param array $showIndexes An array of indexes that correspond to valid indexes in the $items array.
     * @return $this
     *@example If you want the first and second item in the accordion to be expanded,
     * then pass in the array [0, 1] for the value of $showRender.
     * @note The getter and setter are only used for the initial setup. Once the Accordion has been rendered,
     * Bootstrap's built in css and javascript will handle visibility based on user interaction.
     * @chain-method
     */
    public function setShowIndexes(array $showIndexes = []): Accordion
    {
        $this->showIndexes = $showIndexes;
        return $this;
    }

}
