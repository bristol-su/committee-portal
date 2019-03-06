const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');


mix.js(__dirname + '/Resources/assets/js/furtherinformation.js', 'public/js')
    .sass(__dirname + '/Resources/assets/sass/furtherinformation.scss', 'public/css')
    .mergeManifest();
