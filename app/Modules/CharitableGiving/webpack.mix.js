const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');


mix.js(__dirname + '/Resources/assets/js/charitablegiving.js', 'public/js')
    .sass(__dirname + '/Resources/assets/sass/charitablegiving.scss', 'public/css')
    .mergeManifest();
