<?php

namespace PixiiBomb\Essentials\Widgets;

use Illuminate\Support\Str;
use PixiiBomb\Essentials\Traits\HasAlias;
use ReflectionClass;

class Widget
{
    use HasAlias;

    protected int|string|null $key = null;
    protected ?string $name = null;
    protected ?string $filename = null;
    protected ?string $attemptedFilename = null;
    protected ?string $structure = null;
    protected ?string $theme = null;

    public function __construct()
    {
        $this->setName();
        $this->setFilename();
    }

    public function getKey(): int|string|null { return $this->key; }
    public function getName(): ?string { return $this->name; }
    public function getFilename(): ?string { return $this->filename; }
    public function getAttemptedFilename(): ?string { return $this->attemptedFilename; }
    public function getStructure(): ?string { return $this->structure; }
    public function getTheme(): ?string { return $this->theme; }

    public function setKey(int|string|null $key): Widget
    {
        $this->key = $key;
        return $this;
    }

    protected function setName(): void
    {
        $reflection = new ReflectionClass($this);
        $this->name = $reflection->getShortName();
    }

    protected function setFilename(): void
    {
        $structure = Str::kebab($this->structure);
        $folder = empty($this->theme)
            ? config(WIDGET_ACTIVE_THEME)
            : $this->theme;
        $kebabName = Str::kebab($this->name);
        $filename = empty($structure)
            ? $kebabName
            : "{$kebabName}-{$structure}";
        $this->attemptedFilename = "widgets.{$folder}.{$filename}";
        $this->filename = validateView($this->attemptedFilename);

        // try to get the default "bootstrap" widget (must publish pixiibomb/essentials vendor files)
        if($this->filename == E404)
        {
            $bootstrap = "widgets.bootstrap.{$filename}";
            $this->filename = validateView($bootstrap);
        }
    }

    public function setStructure(?string $structure): Widget
    {
        $this->structure = $structure;
        $this->setFilename();
        return $this;
    }

    public function setTheme(?string $theme): Widget
    {
        $this->theme = $theme;
        $this->setFilename();
        return $this;
    }

    #region Helpers
    /**
     * This method can be called on the Component's blade file as a convenient way to create an identifier
     * attribute on an HTML element.
     */
    public function id(): string
    {
        $name = $this->getName();
        $alias = $this->getAlias();
        $unique = empty($alias)
            ? empty($this->key) ? formatRandomIdentifier() : $this->key
            : "{$alias}";
        return formatId("{$name} {$unique}");
    }
    #endregion
}
