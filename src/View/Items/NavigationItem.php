<?php

namespace PixiiBomb\Essentials\View\Items;

use Illuminate\View\View;

class NavigationItem
{
    protected ?string $route = null;

    public function __construct(protected string $href, protected string $label, protected ?string $icon = null)
    {
        $this->setHref($href);
        $this->setLabel($label);
    }

    public function getIcon(): string { return $this->icon; }
    public function getRoute(): string { return $this->route; }
    public function getHref(): string { return $this->href; }
    public function getLabel(): string { return $this->label; }

    public function setRoute(string $route): NavigationItem
    {
        $this->route = $route;
        return $this;
    }

    public function setHref(string $href): NavigationItem
    {
        $this->href = $href;
        return $this;
    }

    public function setLabel(string|View $label): NavigationItem
    {
        $this->label = $label;
        return $this;
    }
}
