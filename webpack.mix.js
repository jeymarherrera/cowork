const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')   // Compila el JavaScript
   .sass('resources/css/app.scss', 'public/css') // Compila SASS a CSS
   .setPublicPath('public');  // Define el directorio de salida

if (mix.inProduction()) {
    mix.version();
}
