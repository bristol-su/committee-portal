const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');


mix.js(__dirname + '/Resources/assets/js/committeedetails.js', 'public/js')
    .sass(__dirname + '/Resources/assets/sass/committeedetails.scss', 'public/css')
    .mergeManifest();
