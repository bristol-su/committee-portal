const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');


mix.js(__dirname + '/Resources/assets/js/presidenthandover.js', 'public/js')
    .sass(__dirname + '/Resources/assets/sass/presidenthandover.scss', 'public/css')
    .mergeManifest();
