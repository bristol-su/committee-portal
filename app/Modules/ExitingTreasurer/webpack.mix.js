const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');


mix.js(__dirname + '/Resources/assets/js/exitingtreasurer.js', 'public/js')
    .sass(__dirname + '/Resources/assets/sass/exitingtreasurer.scss', 'public/css')
    .mergeManifest();
