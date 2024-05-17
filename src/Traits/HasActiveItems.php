<?php

namespace PixiiBomb\Essentials\Traits;

/**
 * Trait HasActiveItem
 *
 * Provides methods to set and get an array of active indexes.
 * A Widget, Component or Blade View may dictate the handling of this Trait's properties.
 * @note This trait is typically used in conjunction with the `HasItems` trait. It enables the specification of
 * multiple indices within the `HasItems->$items` array as 'active'.
 */
trait HasActiveItems
{
    #region Properties
    protected array $activeIndexes = [];
    #endregion

    #region Getters
    public function getActiveIndexes(): array { return $this->activeIndexes; }
    #endregion

    #region Setters
    /**
     * Set the index values that should be displayed when the server renders to the browser.
     *
     * @param array $activeIndexes An array of indexes that correspond to valid indexes in a collection.
     * @return $this
     */
    public function setActiveIndexes(array $activeIndexes = []): static
    {
        $this->activeIndexes = $activeIndexes;
        return $this;
    }
    #endregion
}
