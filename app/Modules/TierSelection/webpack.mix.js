const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');


mix.js(__dirname + '/Resources/assets/js/tierselection.js', 'public/js')
    .sass(__dirname + '/Resources/assets/sass/tierselection.scss', 'public/css')
    .mergeManifest();
