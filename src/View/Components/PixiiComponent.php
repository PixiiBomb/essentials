<?php

namespace PixiiBomb\Essentials\View\Components;

use Illuminate\View\Component;

class PixiiComponent extends Component
{
    protected ?string $alias = null;
    protected ?string $style = null;
    protected array $items = [];
    protected array $styles = [];

    /**
     * Create a new component instance.
     * @param null $data
     */
    public function __construct(public $data = null, public $errors = [])
    {
        $this->setName();
        $this->setStyle($this->style);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return null;
    }

    /**
     * This method can be called on the Component's blade file as a convenient way to create an identifier
     * attribute on an HTML element.
     * @param bool $hasSymbol Set to true if the id should be coupled with the # symbol.
     * @param int|null $i An optional integer value can be passed in for items that are generated through a loop.
     * This $i value represents the current "i" in the loop.
     * @param string|null $suffix A miscellaneous suffix that can optional be added to the end of the id.
     * @return string A string identifier that has been formatted based on the arguments passed into the method.
     * Example: if the component is 'Accordion', the $alias is 'Faqs', and the method call is: id(true, 5, 'Collapse')
     * then this method will return the id: 'Accordion-Faqs-3-Collapse' (indicating that this is the "collapse"
     * portion of item 3 in an Accordion).
     */
    public function id(bool $hasSymbol = false, ?int $i = null, ?string $suffix = null): string
    {
        $name = $this->getName();
        $alias = $this->getAlias() ?? $this->getAlias();

        return formatIdentifier("{$name} {$alias} {$i} {$suffix}", $hasSymbol);
    }

    /**
     * This method should be called on the component's blade file to check if the data is a child of ContentComponent
     * @return bool
     */
    public function valid(): bool
    {
        return $this->data instanceof PixiiComponent;
    }

    public function getName(): ?string { return $this->componentName; }
    public function getAlias(): ?string { return ($this->alias == null) ? formatRandomIdentifier() : $this->alias; }
    public function getItems(): array { return $this->items; }
    public function getStyle(): ?string { return $this->style; }
    public function getdata(): ?PixiiComponent { return $this->data; }

    /**
     * Set base class's (Component) public property (componentName) to the derived class's "nickname".
     * @note The base class Component uses a public property (componentName) that can be set by the Developer, and is
     * meant to act as an "alias" for the Component. To alleviate confusion in terminology, the componentName will
     * be designated at the Component's "nickname". Whereas the term "alias" [ie: setAlias() and getAlias()] is meant
     * to be a unique identifier that can be combined with an id attribute on a html element.
     * @example If the derived class is 'App\View\Components\Accordion', then componentName will be 'Accordion'.
     * @return void
     */
    private function setName(): void
    {
        $this->componentName = basename(get_class($this));
    }

    /**
     * An alias is a unique identifier for a Component (set by the Developer). The "alias" is not to be confused with
     * the Component's "nickname" (componentName), which is the basename() of the Component.
     * @param string $alias A unique name that will represent this component.
     * @return PixiiComponent
     *@example Imagine an Accordion component that displays a list of Frequently Asked Questions. Assume the
     * alias is 'FAQs'. When the Accordion is constructed, the main div might use id="Main-FAQs" and the collapsible
     * div might use id="Collapse-FAQs".
     */
    public function setAlias(string $alias): PixiiComponent
    {
        $this->alias = $alias; //formatIdentifier($alias);
        return $this;
    }

    /**
     * Some Components have different "style" options (not to be confused with a stylesheet). For Example: Each item
     * in a Grid component can look like a Card, Image, or Video, etc. $this->style is a string that represents a
     * style option available for that Component. A child of ContentComponent should define a default $this->style,
     * and define a list of valid styles in the const STYLE array.
     * @chain-method
     * @param string|null $style
     * @return $this
     */
    public function setStyle(?string $style = null): PixiiComponent
    {
        $styles = $this->styles;
        $this->style = in_array($style, $styles) ? $style : $this->style;
        return $this;
    }

    /**
     * Some Components require a group of items (ie: Accordion, Carousel, List, etc).
     * A child of ContentComponent should create a "public function item()" which acts as a constructor for the
     * Component when it's called from a Controller. Each item() should be stored in an array that can be set here.
     * @param $type
     * @param array $items
     */
    public function filterItems($type, array $items = [])
    {
        foreach ($items as $key => $item) {
            if (!$item instanceof $type) {
                unset($items[$key]);
            }
        }

        $this->items = $items;
    }
}
