<?php

namespace PixiiBomb\Essentials\Widgets\Items;

class CollectionItem
{
    protected ?string $type = null;

    public function getType(): string { return $this->type; }

    public function setType(?string $type): CollectionItem
    {
        $this->type = $type;
        return $this;
    }
}
