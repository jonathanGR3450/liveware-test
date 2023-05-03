const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/css/app.css', 'public/css')
   .options({
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.config.js') ],
    });