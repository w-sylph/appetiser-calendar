const mix = require('laravel-mix');
const path = require('path');

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

/* Webpack additional configuration */
mix.webpackConfig({
    resolve: {
        alias: {
            Mixins: path.resolve(__dirname, 'resources/js/mixins'),
            Components: path.resolve(__dirname, 'resources/js/components'),
            Views: path.resolve(__dirname, 'resources/js/views'),
            App: path.resolve(__dirname, 'resources/js'),
        }
    },

    // enable linter on watch
    module: {
        rules: [
            {
                enforce: 'pre',
                test: /\.(js|vue)$/,
                loader: 'eslint-loader',
                exclude: /node_modules/
            }
        ]
    }
});

mix.sass('resources/sass/app.scss', 'public/assets/app.css');
mix.sass('resources/sass/vendor.scss', 'public/assets/vendor.css');

// Keep at the bottom
mix.js('resources/js/app.js', 'public/assets/app.js')
    .extract([
        'vue', 'vue-template-compiler',
        'axios',
        'toastr',
        'bootstrap',
        'moment',
    ]);

mix.vue();

/**
 * Add source of compiled scss to help with debugging
 * Commented due to long compilation when using npm watch, uncomment when doing front end
 */
// if (!mix.inProduction()) {
//  mix.sourceMaps(true, 'source-maps');
// }

mix.version();