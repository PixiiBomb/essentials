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

    'site' => [
        /**
         * This configuration value is used in Meta->setTitle()
         * When this variable is set to true, the page <title> will use 'Site Name - Page Title'
         * When this variable is set to false, the page <title> will use 'Page Title'
         */
        'include_site_name_in_title' => true,
        /**
         * The default scaffold that should be used for content throughout the application.
         * @example If your default scaffold is /resources/views/scaffold/app.blade.php, the value here should be 'scaffold.app'
         */
        'default_app_scaffold' => 'scaffolds.app',
        /**
         * The default component navbar view that should be used for content throughout the application.
         * You can specify navigation per page. If navigation is not specified, this will be the default data.
         * @example If your default navbar is /resources/views/navigation/navbar.blade.php, the value here should be 'navbar'
         */
        'default_navigation_view' => 'navbar'
    ],

    'widgets' => [
        'active_theme' => 'bootstrap',
        'include_alias_comment' => true,
    ]
];
