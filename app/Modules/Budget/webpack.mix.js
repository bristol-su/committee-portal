const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');


mix.js(__dirname + '/Resources/assets/js/budget.js', 'public/js')
    .sass(__dirname + '/Resources/assets/sass/budget.scss', 'public/css')
    .mergeManifest();
