<?php

namespace PixiiBomb\Essentials\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use PixiiBomb\Essentials\Models\Content;
use PixiiBomb\Essentials\Models\Meta;
use PixiiBomb\Essentials\View\Components\Container;

/*
 * All view-models that output Content should extend the ContentController class. The setup() method will always
 * return the appropriate view for the current route and pass in the necessary $this->data array of information.
 * This class should be extended to include commonalities between view-models that display Content.
 */
class ContentController extends Controller
{
    protected string $directory = CONTENT;

    public function __construct()
    {
    }

    /**
     * Each method within a Controller, (that extends ContentController), should return parent::layout($content)
     * to render a new View.
     * @param Content $content
     * @return View Returns a view with an array of data.
     */
    protected function layout(Content $content): View
    {
        return view('layouts.content')->with([CONTENT => $content]);
    }


    /**
     *
     * @param string $alias
     * @return View
     */
    protected function setup(string $alias): View
    {
        $meta = new Meta($alias);

        $containers = [
            (new Container())
                ->setAlias($alias)
                ->setView($this->filename($alias))
        ];

        $content = new Content($meta, $containers);

        return self::layout($content);
    }

    /*protected function abort(): View
    {
        $meta = new Meta('404');
        $containers = [
            (new Container())
                ->setFile(E404)
        ];
        $content = new Content($meta, $containers);
        $index = $this->directoryIndex();
        return view($index)->with([CONTENT => $content]);
    }*/

    /**
     * The "index file" for all Content should be located in /resources/views/content/index.blade.php.
     * @return string The "index file" represented in dot-notation.
     */
    protected function directoryIndex(): string
    {
        $directory = $this->directory;
        $index = INDEX;
        return "$directory.$index";
    }

    /**
     * The 'subdirectory' should be a folder located in /resources/views/content/ that corresponds with the name
     * of the child Controller.
     * @example The subdirectory for HomeController is 'home' located in: /resources/views/content/home/.
     * @param ?string $filename The name of a file located within a child Controller's subdirectory.
     * @return string A subdirectory path written in dot-notation.
     */
    protected function localContent(string|null $filename): string
    {
        $directory = $this->directory;
        $subdirectory = controllerNickname(get_class($this));
        $file = is_null($filename) ? '' : ".{$filename}";
        return "{$directory}.{$subdirectory}{$file}";
    }
}
