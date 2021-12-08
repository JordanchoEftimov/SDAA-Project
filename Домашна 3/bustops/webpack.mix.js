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
    .vue({runtimeOnly: true})
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps(false)
    .extract([
        'vue',
        'bootstrap',
        'font-awesome',
        '@inertiajs/inertia-vue',
        '@inertiajs/progress',
        '@popperjs/core'
    ]);
if (mix.inProduction()) {
    mix.version();
}
