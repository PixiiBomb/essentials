<?php

namespace PixiiBomb\Essentials\View\Components;

use Illuminate\View\Component;

class Container extends PixiiComponent
{
    protected ?string $title = null;
    protected ?string $subtitle = null;
    protected ?string $description = null;
    protected ?string $filename = null;
    protected $containerData = null;
    protected ?Component $component = null;
    protected ?string $isFluid = 'container';

    public function getIsFluid(): string
    {
        return $this->isFluid;
    }

    public function getContainerData()
    {
        return $this->containerData;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function getComponent(): ?Component
    {
        return $this->component;
    }

    /**
     * A title, subtitle and description can be passed into the $content object. This function combines 'title' and 'subtitle'
     * for convenience (since a subtitle is always optional with a title).
     * @note The title, subtitle and description can be retrieved individually.
     * @chain-method
     * @param string|null $title
     * @param string|null $subtitle
     * @param string|null $description
     * @return $this
     */
    public function setHeader(?string $title = null, ?string $subtitle = null, ?string $description = null): Container
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->description = $description;
        return $this;
    }

    /**
     * This function is expected to take in a single file. If the view does not exist, or the view is located in
     * the sub-folders defined in the $ignore array, then the E404 blade file will be used.
     * @chain-method
     * @recommended Use this method to include a file from /resources/views.
     * @param string|null $filename A valid filename, written in dot notation (without the file extension) located in
     * /resources/views/.
     * @return $this
     */
    public function setFilename(?string $filename = null): Container
    {
        $ignore = [COMPONENTS, ERRORS, LAYOUTS];
        $this->filename = viewExists($filename, $ignore);
        return $this;
    }

    public function setComponent(?Component $component): Container
    {
        $this->component = $component;
        return $this;
    }

    public function setContainerData($containerData): Container
    {
        $this->containerData = $containerData;
        return $this;
    }

    public function setIsFluid(bool $isFluid): Container
    {
        $this->isFluid = $isFluid ? 'container-fluid' : 'container';
        return $this;
    }
}
