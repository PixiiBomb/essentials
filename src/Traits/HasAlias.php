<?php

namespace PixiiBomb\Essentials\Traits;

trait HasAlias
{
    protected ?string $alias = null;

    public function getAlias(): ?string { return $this->alias; }

    public function setAlias(string $alias): self {
        $this->alias = $alias;
        return $this;
    }
}
