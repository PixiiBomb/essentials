<?php

namespace PixiiBomb\Essentials\Widgets;

use PixiiBomb\Essentials\Entities\Items\NavigationItem;

class Breadcrumbs extends Widget
{
    const DEFAULT_SHOW_BREADCRUMBS = true;

    #region Properties
    protected array $breadcrumbs = [];
    protected bool $showBreadcrumbs = self::DEFAULT_SHOW_BREADCRUMBS;
    #endregion

    #region Getters
    public function getBreadcrumbs(): array { return $this->breadcrumbs; }
    public function getShowBreadcrumbs(): bool { return $this->showBreadcrumbs; }
    #endregion

    #region Setters
    public function setShowBreadcrumbs(bool $showBreadcrumbs): Breadcrumbs
    {
        $this->showBreadcrumbs = $showBreadcrumbs;
        $this->breadcrumbs = $this->createBreadcrumbs(request()->path());
        return $this;
    }
    #endregion

    #region Helpers
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
    #endregion

    #region Validation
    /**
     * Determines whether the current context is considered invalid based on breadcrumb visibility.
     * This method checks if breadcrumbs are not meant to be shown (`getShowBreadcrumbs()` returns false),
     * and defines the context as invalid if that's the case. The invalid state typically means that
     * the page should not be shown, as it relies on the presence of breadcrumbs.
     * @return bool Returns true if breadcrumbs should not be shown, otherwise false.
     */
    public function isInvalid(): bool
    {
        return !$this->getShowBreadcrumbs();
    }
    #endregion
}
