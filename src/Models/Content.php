<?php

namespace PixiiBomb\Essentials\Models;

use PixiiBomb\Essentials\View\Components\Breadcrumbs;
use PixiiBomb\Essentials\View\Components\Container;
use PixiiBomb\Essentials\View\Components\Navigation;

/**
 * The primary object to push to a View. This class is commonly referred to as "The Content Object" or simply "$content".
 * The purpose of this object is to hold data for a typical webpage, such the page's metadata, individual sections
 * that make up the page's content, and scripts that can be included when the View is created.
 */
class Content
{
    protected ?string $navigation = null;
    protected ?Breadcrumbs $breadcrumbs = null;

    /**
     * @param Meta $meta
     * @param array $containers
     * @param array $scripts
     * @param ?string $navigationFile
     */
    public function __construct(protected Meta $meta, protected array $containers, protected array $scripts = [], string $navigationFile = null)
    {
        $this->setContainers($containers);
        $this->setScripts($scripts);
        $this->setBreadcrumbs();
        $this->setNavigation($navigationFile);
    }

    public function getMeta(): Meta { return $this->meta; }
    public function getContainers(): array { return $this->containers; }
    public function getNavigation(): ?string { return $this->navigation; }
    public function getScripts(): array { return $this->scripts; }
    public function getBreadcrumbs(): Breadcrumbs { return $this->breadcrumbs; }

    /**
     * By default, the constructor will always create Breadcrumbs for the page, so that this parameter does not need to
     * be set when creating a new Content object. Breadcrumbs will always be located in the same place,
     * determined by /resources/layouts/content.blade.php. Functionality is handled through the Breadcrumbs Component.
     * @chain-method
     * @param bool $breadcrumbs Set to true to enable breadcrumbs for this content page. If false, nothing will be
     * displayed in the 'breadcrumbs' placeholder on the layout.
     * @return $this
     */
    public function setBreadcrumbs(bool $breadcrumbs = false): Content
    {
        $this->breadcrumbs = (new Breadcrumbs())->setShowBreadcrumbs($breadcrumbs);
        return $this;
    }

    /**
     * Checks to see if each item in the $containers array is an instance of Container, and updates the valid
     * items with a key that combines the Component's nickname and alias.
     * @note The Component's nickname (componentName) and alias are used to create the key in the $filter array that
     * gets sent to the $content object. Keys should obviously be unique, therefore an item with a duplicate key name
     * will be overwritten by the most recent item. It's up to the common sense of the Developer not to create
     * duplicate keys.
     * @param array $containers Each item in the $containers array should be an object of the Container class.
     * @return $this
     */
    public function setContainers(array $containers): Content
    {
        $filter = [];

        foreach($containers as $i=>$item)
            if($item instanceof Container)
            {
                $key = $item->getAlias();
                if(!$item->getAlias())
                {
                    $key = $i;
                    $item->setAlias($i);
                }
                $filter[formatArrayKey($key)] = $item;
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
    public function setScripts(array $scripts = []): Content
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

    /**
     * Sets the file to use for navigation. The filename should represent the Controller.
     * The primary navigation file for content should be "resources/views/content/navigation.blade.php".
     * @param ?string $navigationFile
     * @return $this
     */
    public function setNavigation(?string $navigationFile = null): Content
    {
        $this->navigation = $navigationFile ?? concatenate(CONTENT, NAVIGATION);
        return $this;
    }
}
