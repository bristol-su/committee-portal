const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');


mix.js(__dirname + '/Resources/assets/js/wabbudget.js', 'public/js')
    .sass(__dirname + '/Resources/assets/sass/wabbudget.scss', 'public/css')
    .mergeManifest();
