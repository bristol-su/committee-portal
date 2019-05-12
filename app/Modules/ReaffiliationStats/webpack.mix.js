const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');


mix.js(__dirname + '/Resources/assets/js/reaffiliationstats.js', 'public/js')
    .sass(__dirname + '/Resources/assets/sass/reaffiliationstats.scss', 'public/css')
    .mergeManifest();
