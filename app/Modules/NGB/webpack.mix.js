const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');


mix.js(__dirname + '/Resources/assets/js/ngb.js', 'public/js')
    .sass(__dirname + '/Resources/assets/sass/ngb.scss', 'public/css')
    .mergeManifest();
