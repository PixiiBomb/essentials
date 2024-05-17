<?php

namespace PixiiBomb\Essentials\Widgets\Items;

class ImageItem extends CarouselItem
{
    protected ?string $alt = null;

    public function __construct(protected ?string $source, ?string $caption)
    {
        $this->type = IMAGE;
        $this->setSource($source);
        $this->setCaption($caption);
    }

    public function getSource(): ?string { return $this->source; }
    public function getAlt(): ?string { return $this->alt; }

    public function setSource(?string $source): ImageItem
    {
        $this->source = $source;
        return $this;
    }

    public function setAlt(?string $alt): ImageItem
    {
        $this->alt = $alt;
        return $this;
    }
}

