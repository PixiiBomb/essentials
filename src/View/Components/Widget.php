<?php

namespace PixiiBomb\Essentials\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Widget extends Component
{
    #region Properties
    protected ?string $alias = null;
    protected ?string $filename = null;
    protected ?string $style = null;
    protected array $styles = [];
    public ?Widget $details = null;
    public array $errors = [];
    #endregion

    #region Constructor
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->setDetails($this->details);
        $this->setName();
        $this->setAlias($this->alias);
    }
    #endregion

    #region Getters
    public function getName(): ?string
    {
        return $this->componentName;
    }

    public function getComponentView(): ?string
    {
        return $this->filename;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function getDetails(): ?Widget
    {
        return $this->details;
    }
    #endregion

    #region Setters
    protected function setDetails(?Widget $details): void
    {
        $this->details = $details;
    }

    /**
     * Set `$this->componentName` to the basename of the child class.
     * @return void
     * @example If the child class is 'App\View\Widgets\Accordion', then componentName will be 'Accordion'.
     * @note Calling `$this->setName()` will automatically call `$this->setComponentView()`.
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
        $split = preg_split('/(?=[A-Z])/', $name, -1, PREG_SPLIT_NO_EMPTY);

        foreach ($split as $word)
            $view .= strtolower($word) . '-';

        $view = rtrim($view, '-');
        $this->filename = Str::slug($view);
    }

    /**
     * An alias is a unique identifier for a Component (set by the Developer). The "alias" is not to be confused with
     * the Component's componentName, which is the basename() of the Component.
     * @param ?string $alias A unique name that will represent this component.
     * @return Widget
     * @example Imagine an Accordion component that displays a list of Frequently Asked Questions. Assume the
     * alias is 'FAQs'. When the Accordion is constructed, the main div might use id="Main-FAQs" and the collapsible
     * div might use id="Collapse-FAQs".
     */
    public function setAlias(?string $alias): Widget
    {
        $this->alias = $alias;
        return $this;
    }
    #endregion

    #region Validation
    /**
     * A child class should override this method and perform any checks that would cause the data to be invalid.
     * This method should be called at the start of the component's view, the return and not display anything if the
     * validation checks are not passed.
     * @return bool
     */
    public function isInvalid(): bool
    {
        return false;
    }

    /**
     * This method should be called on the component's blade file to check if the data is a child of ContentComponent
     * @return bool
     */
    public function valid(): bool
    {
        return $this->details instanceof Widget;
    }
    #endregion

    #region Helpers
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
        $unique = empty($alias)
            ? formatRandomIdentifier()
            : $alias;
        return formatId("{$name} {$unique} {$i} {$suffix}", $hasSymbol);
    }

    /**
     * If an alias has been set, it should be used in the component's blade file.
     * This convenience method was created to quickly create the div id tag to the standard naming convention.
     * If an alias is set, return the string: " id=\"{Component-Name}-{Alias}\"", otherwise return null.
     */
    public function getIdTag(): void
    {
        echo (!empty($this->getAlias()))
            ? " id={$this->id()}"
            : null;
    }

    public function getComment(bool $isStartingTag): void
    {
        $showComment = config(INCLUDE_COMPONENT_ALIAS_COMMENT);
        if($showComment)
        {
            $id = $this->id();
            $prefix = $isStartingTag
                ? 'Widget'
                : '/';
            echo "<!-- {$prefix}: {$id} -->";
        }
    }
    #endregion
}
