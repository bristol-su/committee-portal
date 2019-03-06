const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');


mix.js(__dirname + '/Resources/assets/js/executivesummary.js', 'public/js')
    .sass(__dirname + '/Resources/assets/sass/executivesummary.scss', 'public/css')
    .mergeManifest();
