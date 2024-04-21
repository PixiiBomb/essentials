<?php

namespace PixiiBomb\Essentials\Entities;

use Exception;
use Illuminate\Support\Str;

/**
 * Allows customization of the metadata for each View.
 * @note Ensure that you have published the vendor files for the PixiiBomb\Essentials package, which includes a config
 * file located in the project's root at /config/pixii.php. The 'pixii' config file will allow you to set default string
 * values for each Meta property.
 */
class Meta
{
    /** ---------------------------------------------------------------------------------------- @region CONSTRUCTORS */
    /**
     * Customizes the metadata information for a View.
     * @param string|null $title The value that will appear in a <title>.
     * @param string|null $description Refers to the meta tag, description attribute.
     * @param string|null $keywords Refers to the meta tag, keywords attribute.
     * @param string|null $author Refers to the meta tag, author attribute.
     */
    public function __construct(protected ?string $title, protected ?string $description = null, protected ?string $keywords = null, protected ?string $author = null)
    {
        $this->setTitle($title);
        $this->setDescription($this->description);
        $this->setKeywords($this->keywords);
        $this->setAuthor($this->author);
    }

    /** --------------------------------------------------------------------------------------------- @region GETTERS */
    public function getTitle(): ?string { return Str::title($this->title); }
    public function getDescription(): ?string { return $this->description; }
    public function getKeywords(): ?string { return $this->keywords; }
    public function getAuthor(): ?string { return $this->author; }


    /** --------------------------------------------------------------------------------------------- @region SETTERS */
    /**
     * Set the value of {@link title}.
     * @param string|null $title The value that will be used to set the `title` tag of the page.
     * @return $this
     */
    public function setTitle(?string $title): Meta
    {
        $siteName = config('app.name');
        $pageTitle = $title ?? $this->getLocalization(TITLE);
        $useSiteName = config('pixii.site.'.INCLUDE_SITE_NAME_IN_TITLE);

        if($siteName == $pageTitle && $useSiteName)
        {
            $this->title = $siteName;
        }
        else
        {
            $fullTitle = $useSiteName
                ? "{$siteName} - {$pageTitle}"
                : $pageTitle;
            $this->title = $fullTitle;
        }
        return $this;
    }


    /**
     * Set the value of {@link description}.
     * @param string|null $description
     * @return $this
     */
    public function setDescription(?string $description): Meta
    {
        $this->description = $description ?? $this->getLocalization(DESCRIPTION);
        return $this;
    }

    /**
     * Set the value of {@link author}.
     * @param string|null $author
     * @return $this
     */
    public function setAuthor(?string $author): Meta
    {
        $this->author = $author ?? $this->getLocalization(AUTHOR);
        return $this;
    }

    /**
     * Set the value of {@link keywords}.
     * @param string|null $keywords
     * @return $this
     */
    public function setKeywords(?string $keywords): Meta
    {
        $this->keywords = $keywords ?? $this->getLocalization(KEYWORDS);
        return $this;
    }

    private function getLocalization(string $value): string
    {
        $config = __("pixii-defaults.meta.{$value}");
        return $config ?? "";
    }
}
