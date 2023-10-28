const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.webpackConfig({
    stats: {
        warnings: false,
    }
}).js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .copy('resources/images/*', 'public/images')
    .copy('resources/js/crudobject.js', 'public/js')
    .copy('resources/js/init_members.js', 'public/js')
    .copyDirectory('node_modules/tinymce', 'public/js/tinymce')
    .sourceMaps();
