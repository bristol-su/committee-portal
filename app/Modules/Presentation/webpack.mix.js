const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');


mix.js(__dirname + '/Resources/assets/js/presentation.js', 'public/js')
    .sass(__dirname + '/Resources/assets/sass/presentation.scss', 'public/css')
    .mergeManifest();