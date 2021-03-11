const mix = require('laravel-mix');
require('laravel-mix-tailwind');
require('laravel-mix-purgecss');

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
  .postCss('resources/css/app.css', 'public/css', [
    require('tailwindcss'),
  ])
  .options({
      processCssUrls: false,
  })
  .purgeCss();

mix.postCss('resources/css/download.css', 'public/css');

if (mix.inProduction()) {
  mix.version();
}

if (!mix.inProduction()) {
    mix.browserSync({
        proxy: process.env.MIX_LOCAL || 'moviedb.test',
        notify: false
    });
}
