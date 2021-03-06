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
/*
mix.js('resources/js/app.js', 'public/js').sass('resources/sass/app.scss', 'public/css');
 */
mix.js('resources/js/dashboard/dashboard-main.js', 'public/assets/js/dashboard/dashboard-main.js');
mix.js('resources/js/dashboard/project-main.js', 'public/assets/js/dashboard/project-main.js');
mix.js('resources/js/dashboard/project-details.js', 'public/assets/js/dashboard/project-details.js');
