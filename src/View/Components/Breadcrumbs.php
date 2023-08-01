<?php

namespace PixiiBomb\Essentials\View\Components;

use PixiiBomb\Essentials\View\Items\NavigationItem;

class Breadcrumbs extends PixiiComponent
{
    protected array $breadcrumbs = [];
    protected bool $showBreadcrumbs = false;

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
