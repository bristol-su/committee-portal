const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');


mix.js(__dirname + '/Resources/assets/js/strategicplan.js', 'public/js')
    .sass(__dirname + '/Resources/assets/sass/strategicplan.scss', 'public/css')
    .mergeManifest();
