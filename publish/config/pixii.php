<?php

return [

    /*
    |--------------------------------------------------------------------------
    | PixiiBomb Essentials Configuration
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    CONFIG => [
        INCLUDE_SITE_NAME_IN_TITLE => true
    ],

    META => [
        TITLE => config('app.name'),
        DESCRIPTION => 'Blah blah blah blee blee blah',
        AUTHOR => PIXIIBOMB,
        KEYWORDS => 'i lost my keys',
    ]
];
