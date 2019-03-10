const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');


mix.js(__dirname + '/Resources/assets/js/externalaccounts.js', 'public/js')
    .sass(__dirname + '/Resources/assets/sass/externalaccounts.scss', 'public/css')
    .mergeManifest();
