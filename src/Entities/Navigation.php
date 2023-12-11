<?php

namespace PixiiBomb\Essentials\Entities;

use PixiiBomb\Essentials\Entities\Items\NavigationItem;

class Navigation
{
    /** ------------------------------------------------------------------------------------------ @region PROPERTIES */
    /**
     * An optional name for this navigation group.
     * @var ?string
     */
    protected ?string $name = null;

    /**
     * An optional view that can processes the {@link NavigationMenus} object in order to display the navigation.
     * @var ?string
     */
    protected ?string $view = null;

    private ?string $attemptedView = null;

    protected ?string $stylesheet = null;

    /**
     * An array of {@link NavigationMenus} items.
     * @var array
     */
    protected array $items = [];

    /** ----------------------------------------------------------------------------------------- @region CONSTRUCTOR */
    /**
     * Navigation constructor.
     */
    public function __construct(?string $view = null)
    {
        $this->setView($view);
        $this->setStylesheet('navbar.min');
    }

    /** --------------------------------------------------------------------------------------------- @region GETTERS */
    /**
     * Get the value of {@link name}.
     * @return string|null
     */
    public function getName(): ?string { return $this->name; }

    /**
     * Get the value of {@link view}.
     * @return string|null
     */
    public function getView(): ?string { return $this->view; }

    public function getAttemptedView(): ?string { return $this->attemptedView; }

    public function getStylesheet(): ?string { return $this->stylesheet; }

    /**
     * Get the value of {@link items}.
     * @return array
     */
    public function getItems(): array { return $this->items; }

    /** --------------------------------------------------------------------------------------------- @region SETTERS */
    /**
     * Set the value of {@link name}.
     * @param string $name An optional name for this navigation group.
     * @return $this
     */
    public function setName(string $name): Navigation
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Set the value of {@link view}. This View should be located in /resources/views/navigation/.
     * @param string|null $view An optional View that can processes the {@link NavigationMenus} object.
     * @return $this
     */
    public function setView(?string $view): Navigation
    {
        if(is_null($view))
        {
            $this->attemptedView = null;
            $this->view = null;
            return $this;
        }

        $folder = NAVIGATION;
        $filename = "$folder.$view";
        $this->attemptedView = $filename;
        $this->view = validateView($filename);
        return $this;
    }

    /**
     * Set the value of {@link items}.
     * @param array $items An array of {@link NavigationItem}s.
     * @return $this
     */
    public function setItems(array $items): Navigation
    {
        $this->items = filterArray(NavigationItem::class, $items);
        return $this;
    }

    public function setStylesheet(?string $stylesheet): Navigation
    {
        $this->stylesheet = $stylesheet;
        return $this;
    }

    /** --------------------------------------------------------------------------------------- @region MISCELLANEOUS */
    public static function example(): Navigation
    {
        $items = [
            (new NavigationItem(HOME, HOME)),
            /*(new NavigationItem('/skills', 'skillz'))
                ->setDisabled(true),
            (new NavigationItem('/drop', 'drop it like it\'s hot'))
                ->setItems([
                    (new Navigation())
                        ->setName('Your Mom')
                        ->setItems([
                            (new NavigationItem('/smoosh', 'smoosh magoosh'))
                        ])
                ])*/
        ];

        return (new Navigation())
            ->setItems($items)
            ->setView(PAGE);
    }
}
