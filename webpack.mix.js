let mix = require('laravel-mix');

mix.js('vendor/twbs/bootstrap/dist/js/bootstrap.js', 'public/js')
    .sass('vendor/twbs/bootstrap/scss/bootstrap.scss', 'public/css');

