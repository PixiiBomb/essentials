<?php

return [

    /*
    |--------------------------------------------------------------------------
    | PixiiBomb Essentials Configuration
    |--------------------------------------------------------------------------
    |
    | Refer to the documentation on github.
    |
    */

    CONFIG => [
        LAYOUT_APP => 'layouts.app',
        INCLUDE_SITE_NAME_IN_TITLE => true,
        DEFAULT_NAVBAR_VIEW => NAVBAR
    ],

    META => [
        TITLE => config('app.name'),
        DESCRIPTION => 'Blah blah blah blee blee blah',
        AUTHOR => PIXIIBOMB,
        KEYWORDS => 'i lost my keys',
    ]
];
