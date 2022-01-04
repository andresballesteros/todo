const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .js("resources/js/cheeseburger_menu.js", "public/js")
    .sass("resources/sass/cheeseburger_menu.scss", "public/css")
    .js("resources/js/lightbox.js", "public/js")
    .sass("resources/sass/lightbox.scss", "public/css")
    .js("resources/js/cargos.js", "public/js")
    .js("resources/js/opcionesParametros.js", "public/js")
    .js("resources/js/ciudades.js", "public/js")
    .js("resources/js/confirm.js", "public/js")
    .sourceMaps();

mix.browserSync("http://formulario.test");

if (mix.inProduction()) {
    mix.version();
}
