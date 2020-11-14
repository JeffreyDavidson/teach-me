const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .copy('resources/css/style.bundle.css', 'public/css/style.bundle.css')
    .copy('resources/css/pages/login/login.css', 'public/css/pages/login.css')
    .copy('resources/css/themes/layout/header/base/light.css', 'public/css/themes/layout/header/base/light.css')
    .copy('resources/css/themes/layout/header/menu/light.css', 'public/css/themes/layout/header/menu/light.css')
    .copy('resources/css/themes/layout/brand/dark.css', 'public/css/themes/layout/brand/dark.css')
    .copy('resources/css/themes/layout/aside/dark.css', 'public/css/themes/layout/aside/dark.css')
    .copy('resources/plugins/global/plugins.bundle.css', 'public/plugins/global/plugins.bundle.css')
    .copy('resources/plugins/global/plugins.bundle.js', 'public/plugins/global/plugins.bundle.js')
    .copy('resources/js/scripts.bundle.js', 'public/js/scripts.bundle.js');
