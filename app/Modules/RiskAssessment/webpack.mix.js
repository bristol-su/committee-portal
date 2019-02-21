const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');


mix.js(__dirname + '/Resources/assets/js/riskassessment.js', 'public/js')
    .sass(__dirname + '/Resources/assets/sass/riskassessment.scss', 'public/css')
    .mergeManifest();
