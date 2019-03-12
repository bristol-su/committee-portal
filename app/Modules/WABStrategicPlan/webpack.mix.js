const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');


mix.js(__dirname + '/Resources/assets/js/wabstrategicplan.js', 'public/js')
    .sass(__dirname + '/Resources/assets/sass/wabstrategicplan.scss', 'public/css')
    .mergeManifest();
