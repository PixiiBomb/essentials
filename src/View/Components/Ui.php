<?php

namespace PixiiBomb\Essentials\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use PixiiBomb\Essentials\Widgets\Widget;

class Ui extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public ?Widget $widget = null, public mixed $key = null)
    {
        $this->key = empty($key)
            ? formatRandomIdentifier()
            : $key;

        if(!is_null($widget))
        {
            $this->widget->setKey($key);
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui');
    }
}
