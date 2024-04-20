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
        /**
         * This configuration value is used in Meta->setTitle()
         * When this variable is set to true, the page <title> will use 'Site Name - Page Title'
         * When this variable is set to false, the page <title> will use 'Page Title'
         */
        INCLUDE_SITE_NAME_IN_TITLE => true,
        /**
         * The default layout that should be used for content throughout the application.
         * You can specify layouts per page. If a layout is not specified, this will be the default data.
         * @example If your default layout is /resources/views/layouts/app.blade.php, the value here should be 'layouts.app'
         */
        DEFAULT_APP_LAYOUT => 'layouts.app',
        /**
         * The default component navbar view that should be used for content throughout the application.
         * You can specify navigation per page. If navigation is not specified, this will be the default data.
         * @example If your default navbar is /resources/views/components/navbar.blade.php, the value here should be 'navbar'
         */
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
