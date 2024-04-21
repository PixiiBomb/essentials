<?php

return [
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
    ],

    ACCORDION => [
        HEADER => 'Accordion Header',
        BODY => 'Accordion Body'
    ]
];
