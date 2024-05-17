<?php

namespace PixiiBomb\Essentials\Widgets\Items;

use Illuminate\Support\Facades\Route;
use PixiiBomb\Essentials\Entities\Navigation;

/**
 * Represents an item in a navigation menu. Often used in navigation-based components such as Navbar.
 */
class NavigationItem extends CollectionItem
{
    /** ------------------------------------------------------------------------------------------ @region PROPERTIES */
    /**
     * A boolean value that determines whether the navigation item should be disabled.
     * @var bool
     */
    protected bool $disabled = false;

    /**
     * A list of additional {@link NavigationItem}s that belong to current navigation item. Components that utilize
     * this object can use this array to create dropdown menus.
     * @var array
     */
    protected array $items = [];

    protected ?string $view = null;

    /** ----------------------------------------------------------------------------------------- @region CONSTRUCTOR */
    /**
     * NavigationItem constructor.
     * @param string $route The route name or url for the navigation item.
     * @param string $label The label or text for the navigation item.
     * @param ?string $icon Optional icon for the navigation item.
     */
    public function __construct(protected string $route, protected string $label, protected ?string $icon = null)
    {
        $this->type = 'navigation';
        $this->setRoute($route);
        $this->setLabel($label);
        $this->setIcon($icon);
    }

    /** --------------------------------------------------------------------------------------------- @region GETTERS */
    /**
     * Get the value of {@link disabled}.
     * @return bool
     */
    public function getDisabled(): bool { return $this->disabled; }

    /**
     * Get the value of {@link items}.
     * @return array
     */
    public function getItems(): array { return $this->items; }

    /**
     * Get the value of {@link route}.
     * @return string
     */
    public function getRoute(): string { return $this->route; }

    /**
     * Get the value of {@link label}.
     * @return string
     */
    public function getLabel(): string { return $this->label; }

    /**
     * Get the value of {@link icon}.
     * @return ?string
     */
    public function getIcon(): ?string { return $this->icon; }

    public function getView(): ?string { return $this->view; }

    /** --------------------------------------------------------------------------------------------- @region SETTERS */
    /**
     * Set the value of {@link disabled}.
     * @param bool $disabled Set to true if this navigation item should be disabled. Otherwise, set this value as false
     * to enable the navigation item.
     * @return $this
     */
    public function setDisabled(bool $disabled): NavigationItem
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * Set the value of {@link items}.
     * @param array $items A list of additional {@link NavigationItem}s that belong to current navigation item.
     * @return $this
     */
    public function setItems(array $items): NavigationItem
    {
        $this->items = filterArray(Navigation::class, $items);
        return $this;
    }

    public function setView(?string $view): NavigationItem
    {
        $this->view = $view;
        return $this;
    }

    /**
     * Set the value of {@link route}. Invalid routes will default to {@link createRouteFromPath()}.
     * @param string $route The route name or url for the navigation item.
     * @return $this
     */
    public function setRoute(string $route): NavigationItem
    {
        $this->route = Route::has($route)
            ? route($route)
            : createRouteFromPath($route);
        return $this;
    }

    /**
     * Set the value of {@link label}.
     * @param string $label The label or text for the navigation item.
     * @return $this
     */
    public function setLabel(string $label): NavigationItem
    {
        $this->label = titleCase($label);
        return $this;
    }

    /**
     * Set the value of {@link icon}.
     * @param ?string $icon Optional icon for the navigation item.
     * @return $this
     */
    public function setIcon(?string $icon): NavigationItem
    {
        $this->icon = $icon;
        return $this;
    }
}
