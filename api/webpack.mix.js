let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
  .sass('resources/assets/sass/app.scss', 'public/css');

mix.scripts([
  'node_modules/json-browse/json-browse/jquery.json-browse.js'
], 'public/js/vendor.js')

mix.styles([
  'node_modules/json-browse/json-browse/jquery.json-browse.css'
], 'public/css/vendor.css')
