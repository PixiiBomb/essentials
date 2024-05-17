<?php

namespace PixiiBomb\Essentials\Traits;

use Illuminate\View\View;

trait File
{
    use HasView;

    protected ?View $view = null;

    public function getView(): ?View { return $this->view; }
}
