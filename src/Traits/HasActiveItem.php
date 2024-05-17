<?php

namespace PixiiBomb\Essentials\Traits;

/**
 * Trait HasActiveItem
 *
 * Provides methods to set and get an active index.
 * A Widget, Component or Blade View may dictate the handling of this Trait's properties.
 * @note This trait is typically used in conjunction with the `HasItems` trait. It enables the specification of
 * multiple indices within the `HasItems->$items` array as 'active'.
 */
trait HasActiveItem
{
    #region Properties
    /**
     * @var int The index of the currently active item in the collection.
     */
    protected int $activeIndex = 0;
    #endregion

    #region Getters
    /**
     * Retrieves the active index.
     *
     * @return int The index of the active item in the collection.
     */
    public function getActiveIndex(): int { return $this->activeIndex; }
    #endregion

    #region Setters
    /**
     * Sets the active index of the collection.
     *
     * @param int $activeIndex The new index to set as active.
     * @return static Returns instance of the current class for method chaining.
     */
    public function setActiveIndex(int $activeIndex): static
    {
        $this->activeIndex = $activeIndex;
        return $this;
    }
    #endregion
}
