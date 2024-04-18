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
        /*
         * This configuration value is used in Meta->setTitle()
         * When this variable is set to true, the page <title> will use 'Site Name - Page Title'
         * When this variable is set to false, the page <title> will use 'Page Title'
         */
        INCLUDE_SITE_NAME_IN_TITLE => true,
        DEFAULT_NAVBAR_VIEW => NAVBAR
    ],

    META => [
        /**
         * A default page <title> that will appear if a Controller does not use Meta->setTitle().
         */
        TITLE => config('app.name'),
        /**
         * A default <meta name="description" content="{YOUR VALUE HERE}"> if a Controller does not use Meta->setDescription().
         */
        DESCRIPTION => 'Blah blah blah blee blee blah',
        /**
         * A default <meta name="author" content="{YOUR VALUE HERE}"> if a Controller does not use Meta->setAuthor().
         */
        AUTHOR => PIXIIBOMB,
        /**
         * A default <meta name="keywords" content="{YOUR VALUE HERE}"> if a Controller does not use Meta->setKeywords().
         */
        KEYWORDS => 'i lost my keys',
    ]
];
