<?php

namespace PixiiBomb\Essentials\Traits;

trait HasCaption
{
    protected ?string $caption = null;

    public function getCaption(): ?string { return $this->caption; }

    public function setCaption(?string $caption): static
    {
        $this->caption = $caption;
        return $this;
    }
}
