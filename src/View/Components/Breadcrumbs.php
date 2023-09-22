<?php

namespace PixiiBomb\Essentials\View\Components;

use PixiiBomb\Essentials\Entities\Items\NavigationItem;

class Breadcrumbs extends PixiiComponent
{
    const DEFAULT_SHOW_BREADCRUMBS = true;

    protected array $breadcrumbs = [];
    protected bool $showBreadcrumbs = self::DEFAULT_SHOW_BREADCRUMBS;

    public function getBreadcrumbs(): array { return $this->breadcrumbs; }
    public function getShowBreadcrumbs(): bool { return $this->showBreadcrumbs; }

    public function setShowBreadcrumbs(bool $showBreadcrumbs): Breadcrumbs
    {
        $this->showBreadcrumbs = $showBreadcrumbs;
        $this->breadcrumbs = $this->createBreadcrumbs(request()->path());
        return $this;
    }

    protected function createBreadcrumbs(string $path): array
    {
        $breadcrumbs = explode('/', $path);
        $currentPath = '';
        $items = [];

        foreach ($breadcrumbs as $breadcrumb) {
            $currentPath .= '/' . $breadcrumb;
            $items[] = new NavigationItem($currentPath, ucfirst($breadcrumb));
        }

        return $items;
    }
}
