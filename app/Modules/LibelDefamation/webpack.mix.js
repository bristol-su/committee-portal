const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');


mix.js(__dirname + '/Resources/assets/js/libeldefamation.js', 'public/js')
    .sass(__dirname + '/Resources/assets/sass/libeldefamation.scss', 'public/css')
    .mergeManifest();
