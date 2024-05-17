<?php

namespace PixiiBomb\Essentials\Traits;

/**
 * Trait HasItems
 *
 * Encapsulates an `$items` array and includes a `$filterType` property to selectively filter items added to the array.
 * A Widget, Component or Blade View may dictate the handling of this Trait's properties.
 */
trait HasItems
{
    // @todo: add an image series, glob a folder, or enter by numbers

    #region Properties
    /**
     * @var string|null The type of items the collection is filtered by.
     */
    protected ?string $filterType = null;

    /**
     * @var array The array of items in the collection.
     */
    protected array $items = [];
    #endregion

    #region Getters
    /**
     * Retrieves the array of items.
     *
     * @return array An array of items currently managed by this trait.
     */
    public function getItems(): array { return $this->items; }
    #endregion

    #region Setters
    /**
     * Sets the items in the collection.
     * If a filter type is specified, filters items by the type before setting the array.
     *
     * @param array $items An array of items to be managed.
     * @return static Returns instance of the current class for method chaining.
     */
    public function setItems(array $items = []): static
    {
        $this->items = (empty($this->filterType))
            ? $items
            : filterArray($this->filterType, $items);
        return $this;
    }
    #endregion
}
