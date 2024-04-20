<?php

namespace PixiiBomb\Essentials\Widgets;

use PixiiBomb\Essentials\Enums\BootstrapPalette;

class Alert extends Widget
{
    #region Properties
    protected ?string $bootstrapPalette = null;
    #endregion

    #region Getters
    public function getBootstrapPalette(): string { return $this->bootstrapPalette; }
    #endregion

    #region Setters
    public function setBootstrapPalette(?BootstrapPalette $bootstrapPalette): Alert
    {
        $this->bootstrapPalette = $bootstrapPalette;
        return $this;
    }
    #endregion

    #region Validation
    public function isInvalid(): bool
    {
        return false;
    }
    #endregion
}
