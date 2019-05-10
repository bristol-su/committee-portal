const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');
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

// mix.mergeManifest();
mix.setPublicPath('./public');

let fs = require('fs-extra');
let modules = fs.readdirSync('app/Modules');

if(modules && modules.length > 0) {
    modules.forEach((module) => {
        let path = `./app/Modules/${module}/webpack.mix.js`;
        if (fs.existsSync(path)) {
            require(path);
        }
    });
}


mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/vendor.js', 'public/js')
    .js('resources/js/sitesettings.js', 'public/js')
    .js('resources/js/portal.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .mergeManifest();

// if (mix.inProduction()) {
//     mix.version().mergeManifest();
// }