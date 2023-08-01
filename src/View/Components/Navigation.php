<?php

namespace PixiiBomb\Essentials\View\Components;

use PixiiBomb\Essentials\View\Items\NavigationItem;

class Navigation extends PixiiComponent
{
    protected ?string $filename = null;

    public function getFile(): ?string { return $this->filename; }

    public function setFile(?string $filename): Navigation
    {
        $this->filename = $filename;
        return $this;
    }

    protected function createNavigation(string $path): array
    {
        $Navigation = explode('/', $path);
        $currentPath = '';
        $items = [];

        foreach ($Navigation as $breadcrumb) {
            $currentPath .= '/' . $breadcrumb;
            $items[] = new NavigationItem($currentPath, ucfirst($breadcrumb));
        }

        return $items;
    }
}
