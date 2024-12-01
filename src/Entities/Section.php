<?php

namespace PixiiBomb\Essentials\Entities;

use Illuminate\View\Component;
use PixiiBomb\Essentials\Traits\File;
use PixiiBomb\Essentials\Traits\HasAlias;
use PixiiBomb\Essentials\Widgets\Widget;

class Section
{
    use HasAlias;
    use File;

    #region Properties
    // @todo : needs title, description, tagline
    protected ?string $title = null;
    protected ?string $description = null;
    protected ?string $tagLine = null;
    protected Widget|Component|string|null $asset = null;
    protected ?string $type = null;
    #endregion

    #region Constructor
    public function __construct(Widget|Component|string|null $asset = null)
    {
        $this->setAsset($asset);
    }
    #endregion

    #region Getters
    public function getTitle(): ?string { return $this->title; }
    public function getDescription(): ?string { return $this->description; }
    public function getTagLine(): ?string { return $this->tagLine; }
    public function getAsset(): Widget|Component|string|null { return $this->asset; }
    #endregion

    #region Setters
    public function setTitle(?string $title): Section
    {
        $this->title = $title;
        return $this;
    }

    public function setDescription(?string $description): Section
    {
        $this->description = $description;
        return $this;
    }

    public function setTagLine(?string $tagLine): Section
    {
        $this->tagLine = $tagLine;
        return $this;
    }

    public function setAsset(Widget|Component|string|null $asset): Section
    {
        $this->asset = $asset;

        if(is_string($asset))
        {
            $this->type = VIEW;
            $this->setFilename($asset);
        }

        if($asset instanceof Widget)
        {
            $this->type = WIDGET;
        }

        if($asset instanceof Component)
        {
            $this->type = COMPONENT;
        }

        return $this;
    }
    #endregion
}
