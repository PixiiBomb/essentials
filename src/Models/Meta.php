<?php

namespace PixiiBomb\Essentials\Models;

use Illuminate\Support\Str;

/**
 * Allows customization of the metadata for each View.
 * Default values for the title tag and the meta tag's description, keywords, and author can be set in this class,
 * and should be personalized in the method call of a Controller extending SimpleController .
 */
class Meta
{
    /**
     * Customizes the metadata information for a View.
     * @param string $title The value that will appear in a <title>.
     * @param string|null $description Refers to the meta tag, description attribute.
     * @param string|null $keywords Refers to the meta tag, keywords attribute.
     * @param string|null $author Refers to the meta tag, author attribute.
     */
    public function __construct(protected string $title, protected ?string $description = null, protected ?string $keywords = null, protected ?string $author = null)
    {
        /*$this->title = $title ?? __('config.meta.title');
        $this->description = $description ?? __('config.meta.description');
        $this->keywords = $keywords ?? __('config.meta.keywords');
        $this->author = $author ?? __('config.meta.title');*/
    }

    public function getTitle(): ?string { return Str::title($this->title); }
    public function getDescription(): ?string { return $this->description; }
    public function getKeywords(): ?string { return $this->keywords; }
    public function getAuthor(): ?string { return $this->author; }
}
