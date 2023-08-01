<?php

use Illuminate\Support\Str;

/**
 * The 'confirmed' rule in Laravel expects a second input field with the same name as the original.
 * This method ensures that the "second" input that needs to be confirmed is named properly, based on the
 * original's name.
 * @example If the $name is 'password', then this method will return 'password_confirmation'.
 * @param string $name The "original" input's name.
 * @return string
 */
function formatConfirmationInput(string $name): string
{
    return "{$name}_".CONFIRMATION;
}

function getMethodName(string $method)
{
    $method = explode('::', basename($method));
    return end($method);
}

function concatenateId(string $prefix, string $suffix): string
{
    return Str::title($prefix).'-'.Str::title($suffix);
}

function concatenate(string $prefix, string $suffix, bool $usePackage = true, string $separator = '.'): string
{
    return getFromPackage("{$prefix}{$separator}{$suffix}");
}

function concatenateRoute(string $prefix, string $suffix): string
{
    return route("{$prefix}.{$suffix}");
}

/*
 * The PixiiBomb Essentials package will always use the 'pixii' prefix in the PixiiBombEssentialsServiceProvider.
 * This prefix is set up in the configuration file located in /packages/pixii/essentials/config.setup.
 * Use php artisan vendor:publish to publish registered services in the package's service provider.
 * This will create a corresponding config file in /config/pixii.php.
 * The configuration variables from /packages/pixii/essentials/config.setup can now be used.
 * This method will retrieve the 'prefix' configuration variable from the customer configuration file.
 */
function getFromPackage(string $component): ?string
{
    $package_prefix = config(PIXII.'.'.PREFIX);

    if(is_null($package_prefix))
        return $component;

    return strtolower("{$package_prefix}::{$component}");
}

/**
 * Component's MUST have an alias, even though the attribute is optional. (The attribute is optional to reduce
 * redundancy when creating the component in a Controller and then passing the $object to a dynamic component)
 * This function will create a random alphanumeric alias.
 * @return string
 */
function formatRandomIdentifier(): string
{
    return formatIdentifier(uniqid(chr(rand(65, 90))));
}

/**
 * Ensure that any "id" (used as an attribute for an HTML element) follows the same format.
 * This function uses the Laravel String helper class to convert the $key into a mix of Title Case and kebab-case.
 * @example 'pixiiBomb Dot com' will be formatted to 'Pixii-Bomb-Dot-Com'
 * @param int|string $key A string that represents an "id" attribute for an HTML element.
 * @param bool $hasSymbol Optionally return the # symbol along with the formatted $key.
 * @return string The $key formatted to Title-Kebab-Case.
 */
function formatIdentifier(int|string $key, bool $hasSymbol = false): string
{
    $prefix = $hasSymbol ? '#' : '';
    return $prefix.Str::title(Str::slug($key));
}

/**
 * Ensure that array keys follow the same format. This function uses the Laravel
 * String helper class to convert the $key into kebab-case. This is a convenience function so that the Str class
 * does not need to be imported on blade files.
 * @example 'Pixii BombDot Com' will be formatted to 'pixii-bomb-dot-com'
 * @param string $key A string that represents a possible key in an array with key/value pairs.
 * @return string The $key formatted to kebab-case.
 */
function formatArrayKey(string $key): string
{
    return Str::kebab($key);
}

/**
 * Formats the date received (most likely from the YouTube API) into a readable date format to input into the Database.
 * @param string $date The date received, most likely in Zulu (UTC) time.
 * @param bool $includeTime By default, fields in the database will use $table->dateTime(). Setting this value to false
 * will return the formatted date, without the time.
 * @return string
 */
function formatDateTimeForMySql(string $date, bool $includeTime = true): string
{
    $time = $includeTime ? ' H:i:s' : null;
    return date("Y-m-d $time", strtotime($date));
}

function formatDateYearOnly(string $date): string
{
    return date("Y", strtotime($date));
}

/**
 * The standard naming convention for Laravel view-models is "{NAME}Controller" where {NAME} is the custom
 * name you've given to the Controller. This function will return the Controller's basename and exclude the
 * string "Controller".
 * @example 'App\Http\view-models\HomeController' will be formatted to 'Home'
 * @param string $controller The string name of a Controller class.
 * @return string The $controller formatted to it's "nickname".
 */
function controllerNickname(string $controller): string
{
    return str_replace(CONTROLLER, '', strtolower(basename($controller)));
}

/**
 * Check to see if a Component exists, by looking for its View in /resources/views/resources/.
 * If the component does not exist, the "missing" template will be returned. This template can be customized in
 * /resources/views/resources/missing.blade.php
 * @param string|null $component The filename (without the file extension) of a component located in the 'resources' folder.
 * @return string|null If the component exists, the original $component filename will be returned. Otherwise, the
 * 'missing' filename will be returned.
 */
function componentExists(?string $component): ?string
{
    $components = COMPONENTS;
    return view()->exists(strtolower("$components.$component"))
        ? $component
        : E404;
}

/**
 * Check to see if a View exists, by looking in /resources/views/.
 * If the view does not exist, the "404" template will be returned. This template can be customized in
 * /resources/views/errors/404.blade.php
 * @param string|null $view The filename (without the file extension) of a view located in the 'views' folder.
 * @param array $ignore  An array of sub-folders within /resources/views that should be considered "invalid".
 * @return string If the view exists, the original $view filename will be returned. Otherwise, the
 * '404' filename will be returned.
 */
function viewExists(?string $view, array $ignore = []): string
{
    if(!empty($ignore))
    {
        foreach($ignore as $folder)
            if(str_contains($view, $folder))
                return E404;
    }

    $view_from_package = getFromPackage($view);
    if(view()->exists($view_from_package))
        return $view_from_package;

    if(view()->exists($view))
        return $view;

    return getFromPackage(E404);
}

/**
 * @param string $script
 * @return string|null
 */
function scriptExists(string $script): ?string
{
    $path = "js/$script.js";
    $public = public_path($path);
    return file_exists($public)
        ? asset($path)
        : null;
}

/**
 * A convenience function to retrieve an image from storage.
 * @param string $filename The filename of an image (without the extension) located in the storage's images folder.
 * Include any subdirectories (using forward slashes) if the image is nested.
 * @param string $extension The image is assumed to be a PNG, but if it is not, use a predefined constant value to
 * represent an image extension.
 * @return string|null The asset path to the requested image.
 */
function src(string $filename, string $extension = PNG): ?string
{
    $storage = "storage/images/$filename.$extension";

    $url = url($storage);
    $public = public_path($storage);

    return file_exists($public) ? $url : null;
}

/**
 * A convenience function to output a common <img> tag.
 * @param string $filename The filename of an image (without the extension) located in the storage's images folder.
 * Include any subdirectories (using forward slashes) if the image is nested.
 * @param string $extension The image is assumed to be a PNG, but if it is not, use a predefined constant value to
 * represent an image extension.
 * @param string|null $alt
 * @param string|null $classes
 * @return string|null
 */
function img(string $filename, string $extension = PNG, ?string $alt = null, ?string $classes = 'img-fluid'): ?string
{
    $src = src($filename, $extension);
    $alt = $alt ?? basename($filename);
    return "<img src='$src' alt='$alt' class='$classes'>";
}

function subNavigation(string $file): string
{
    $folder = NAVIGATION;
    $subFolder = SUB_NAVIGATION;
    $view = "$folder.$subFolder.$file";
    return view()->exists($view)
        ? $view
        : E404;
}
