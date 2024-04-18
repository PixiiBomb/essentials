<?php

namespace PixiiBomb\Essentials\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class PixiiComponent extends Component
{
    protected ?string $alias = null;
    protected ?string $filename = null;
    protected ?string $style = null;
    protected array $items = [];
    protected array $styles = [];

    /**
     * Create a new component instance.
     * @param null $details
     */
    public function __construct(public $details = null, public $errors = [])
    {
        $this->setDetails($details);
        $this->setName();
        $this->setStyle($this->style);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): \Illuminate\Contracts\View\View
    {
        $filename = $this->getComponentView();
        return view("components.{$filename}");
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
        $alias = $this->getAlias();
        return formatId("{$name} {$alias} {$i} {$suffix}", $hasSymbol);
    }

    /**
     * This method should be called on the component's blade file to check if the data is a child of ContentComponent
     * @return bool
     */
    public function valid(): bool
    {
        return $this->details instanceof PixiiComponent;
    }

    public function getName(): ?string { return $this->componentName; }
    public function getComponentView(): ?string { return $this->filename; }
    public function getAlias(): ?string { return $this->alias; }
    public function getItems(): array { return $this->items; }
    public function getStyle(): ?string { return $this->style; }
    public function getDetails(): ?PixiiComponent { return $this->details; }

    protected function setDetails(?PixiiComponent $details): void
    {
        $this->details = $details;
    }

    /**
     * Set `$this->componentName` to the basename of the child class.
     * @example If the child class is 'App\View\Components\Accordion', then componentName will be 'Accordion'.
     * @note Calling `$this->setName()` will automatically call `$this->setComponentView()`.
     * @return void
     */
    protected function setName(): void
    {
        $this->componentName = basename(get_class($this));
        $this->setComponentView($this->componentName);
    }

    /**
     * The component's view should be identical to `$this->componentName`, written in kebab-case.
     * @note Calling `$this->setName()` will automatically call this method.
     * @param string $name
     * @return void
     */
    protected function setComponentView(string $name): void
    {
        $view = '';
        $split = preg_split('/(?=[A-Z])/', $name, -1,PREG_SPLIT_NO_EMPTY);

        foreach($split as $word)
            $view .= strtolower($word) . '-';

        $view = rtrim($view, '-');
        $this->filename = Str::slug($view);
    }

    /**
     * An alias is a unique identifier for a Component (set by the Developer). The "alias" is not to be confused with
     * the Component's componentName, which is the basename() of the Component.
     * @param string $alias A unique name that will represent this component.
     * @return PixiiComponent
     * @example Imagine an Accordion component that displays a list of Frequently Asked Questions. Assume the
     * alias is 'FAQs'. When the Accordion is constructed, the main div might use id="Main-FAQs" and the collapsible
     * div might use id="Collapse-FAQs".
     */
    public function setAlias(string $alias): PixiiComponent
    {
        $this->alias = $alias == "0"
            ? formatRandomIdentifier()
            : $alias;
        return $this;
    }

    /**
     * Some Components have different "style" options (not to be confused with a stylesheet). For Example: Each item
     * in a Grid component can look like a Card, Image, or Video, etc. $this->style is a string that represents a
     * style option available for that Component. A child of ContentComponent should define a default $this->style,
     * and define a list of valid styles in the const STYLE array.
     * and define a list of valid styles in the const STYLE array.
     * @param string|null $style
     * @return PixiiComponent
     */
    public function setStyle(?string $style = null): PixiiComponent
    {
        $styles = $this->styles;
        $this->style = in_array($style, $styles) ? $style : $this->style;
        return $this;
    }
}
