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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/hpsearch.js', 'public/js')
    // .js('node_modules/summernote/dist/summernote.js', 'public/js')
    // .styles([
    //     'node_modules/summernote/dist/summernote.css'
    // ], 'public/css')
   .sass('resources/sass/app.scss', 'public/css');
