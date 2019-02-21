const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');


mix.js(__dirname + '/Resources/assets/js/incomingtreasurer.js', 'public/js')
    .sass(__dirname + '/Resources/assets/sass/incomingtreasurer.scss', 'public/css')
    .mergeManifest();
