<?php

namespace PixiiBomb\Essentials\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use PixiiBomb\Essentials\Entities\Page;

class PageController extends Controller
{
    /** ------------------------------------------------------------------------------------------ @region PROPERTIES */
    /**
     * A nickname associated with this type of controller. This alias is often used as the suffix of a layout file,
     * as the name of a sub-folder within /resources/views/, and as the `body` id for the content page rendered to
     * the browser.
     * @var string
     */
    private string $alias;

    protected string $layout = VERTICAL;

    /** ----------------------------------------------------------------------------------------- @region CONSTRUCTOR */
    /**
     * ContentController constructor.
     * This constructor will automatically set the {@link alias}.
     */
    public function __construct()
    {
        $this->setAlias($this->alias ?? basename(get_class($this)));
    }

    /** --------------------------------------------------------------------------------------------- @region GETTERS */
    /**
     * Get the value of {@link alias}.
     * @return string
     */
    public function getAlias(): string { return $this->alias; }

    /**
     * Get the value of {@link layout}.
     * @return string
     */
    public function getLayout(): string { return $this->layout; }

    /** --------------------------------------------------------------------------------------------- @region SETTERS */
    /**
     * Set the value of {@link alias}. The constructor will automatically call this method using the basename of
     * the child Controller without the 'Controller' suffix.
     * @param string $alias The string alias to set for this Controller.
     * @return $this
     *@example If the child Controller is 'DocumentationController', and $directory = null, then $this->directory will
     * be 'Documentation'.
     */
    protected function setAlias(string $alias): PageController
    {
        $this->alias = controllerNickname($alias);
        return $this;
    }

    protected function setLayout(string $layout): PageController
    {
        $this->layout = $layout;
        return $this;
    }

    /** --------------------------------------------------------------------------------------- @region MISCELLANEOUS */
    /**
     * Each method within a Controller, (that extends PageController), should return parent::page($page)
     * to render a new View.
     * @param Page $page
     * @return View Returns a View with a $route, $id and $page object.
     */
    protected function page(Page $page): View
    {
        $route = \Illuminate\Support\Facades\Route::getCurrentRoute();
        $id = formatId($this->getAlias().'-'.$route->getActionMethod());

        $layout = $this->getLayout();
        $formatLayout = formatId($layout);
        $layoutView = "layouts.{$layout}";

        if(!view()->exists($layoutView))
        {
            $file = str_replace('.', '/', $layoutView);
            dd("PageController cannot return page.\nPageController->layout = \"{$layout}\";\nThe layout: \"/resources/views/{$file}.blade.php\" does not exist");
        }

        return view($layoutView)
                ->with([
                    ID => $id,
                    LAYOUT => "Layout-{$formatLayout}",
                    CONTROLLER => $this,
                    PAGE => $page
                ]);
    }

    /**
     * The "index file" for all Content should be located in /resources/views/content/portfolio.blade.php.
     * @return string The "index file" represented in dot-notation.
     */
    protected function directoryIndex(): string
    {
        $directory = $this->alias;
        $index = INDEX;
        return "$directory.$index";
    }

    /**
     * The 'subdirectory' should be a folder located in /resources/views/content/ that corresponds with the name
     * of the child Controller.
     * @example The subdirectory for HomeController is 'home' located in: /resources/views/content/home/.
     * @param string|null $filename The name of a file located within a child Controller's subdirectory.
     * @return string A subdirectory path written in dot-notation.
     */
    protected function localContent(?string $filename): string
    {
        $subdirectory = $this->getAlias();
        $file = is_null($filename)
            ? ''
            : ".{$filename}";
        return "pages.{$subdirectory}{$file}";
    }
}
