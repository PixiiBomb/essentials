<?php

namespace PixiiBomb\Essentials\Entities;

use PixiiBomb\Essentials\View\Components\Breadcrumbs;
use PixiiBomb\Essentials\View\Components\Container;

/**
 * The primary object to push to a View. This class is commonly referred to as "The Page Object" or simply "$page".
 * The purpose of this object is to hold data for a typical webpage, such the page's metadata, individual sections
 * that make up the page's content, and scripts that can be included when the View is created.
 */
class Page
{
    protected ?Meta $meta = null;
    protected ?Breadcrumbs $breadcrumbs = null;
    protected array $stylesheets = [];

    /**
     * @param array $containers
     * @param array $scripts
     * @param ?Navigation $navigation
     */
    public function __construct(protected array $containers = [], protected array $scripts = [], protected ?Navigation $navigation = null)
    {
        $this->setMeta(new Meta(null));
        $this->setContainers($containers);
        $this->setScripts($scripts);
        $this->setNavigation($navigation ?? new Navigation(getDefaultNavbarView()));
    }

    public function getMeta(): ?Meta { return $this->meta; }
    public function getContainers(): array { return $this->containers; }
    public function getNavigation(): ?Navigation { return $this->navigation; }
    public function getScripts(): array { return $this->scripts; }
    public function getStylesheets(): array { return $this->stylesheets; }
    public function getBreadcrumbs(): ?Breadcrumbs { return $this->breadcrumbs; }


    public function setMeta(?Meta $meta): Page
    {
        $this->meta = $meta;
        return $this;
    }

    /**
     * By default, the constructor will always create Breadcrumbs for the page, so that this parameter does not need to
     * be set when creating a new Content object. Breadcrumbs will always be located in the same place,
     * determined by /resources/layouts/content.blade.php. Functionality is handled through the Breadcrumbs Component.
     * @chain-method
     * @param bool $breadcrumbs Set to true to enable breadcrumbs for this content page. If false, nothing will be
     * displayed in the 'breadcrumbs' placeholder on the layout.
     * @return $this
     */
    public function setBreadcrumbs(bool $breadcrumbs = Breadcrumbs::DEFAULT_SHOW_BREADCRUMBS): Page
    {
        $this->breadcrumbs = (new Breadcrumbs())->setShowBreadcrumbs($breadcrumbs);
        return $this;
    }

    /**
     * Checks to see if each item in the $containers array is an instance of Container, and updates the valid
     * items with a key that combines the Component's nickname and alias.
     * @note The Component's nickname ($componentName) and alias are used as the unique identifiers for items in the
     * $filter array sent to the $content object. Objects keys should be unique, therefore, if two items have the same
     * identifier, the newer one will replace the older one. It's the Developer's responsibility to avoid using the
     * same identifier for multiple items.
     * @param array $containers Each item in the $containers array should be an object of the Container class.
     * @return $this
     */
    public function setContainers(array $containers): Page
    {
        $filter = [];

        foreach($containers as $i=>$item)
        {
            if($item instanceof Container)
            {
                $key = $item->getAlias();
                if(is_null($item->getAlias()))
                {
                    $key = $i;
                    $item->setAlias($i);
                }
                $filter[formatArrayKey($key)] = $item;
            }
        }

        $this->containers = $filter;
        return $this;
    }

    /**
     * The purpose of this method is to check the javascript filenames passed into the constructor and validate
     * that each filename is an existing javascript file located in the public directory.
     * @directory /public/js/
     * @param array $scripts An array of javascript filenames (without the .js extension)
     * @return $this
     */
    public function setScripts(array $scripts = []): Page
    {
        $filter = [];

        foreach($scripts as $key=>$script)
        {
            if(scriptExists($script))
                $filter[$key] = scriptExists($script);
        }

        $this->scripts = $filter;
        return $this;
    }

    public function setStylesheets(array $stylesheets = []): Page
    {
        $this->stylesheets = $stylesheets;
        return $this;
    }

    /**
     * Sets the navigation object for this page.
     * @param ?Navigation $navigation
     * @return $this
     */
    public function setNavigation(?Navigation $navigation = null): Page
    {
        $this->navigation = $navigation;
        return $this;
    }

}
