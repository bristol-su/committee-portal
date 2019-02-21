const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');


mix.js(__dirname + '/Resources/assets/js/maincontacts.js', 'public/js')
    .sass(__dirname + '/Resources/assets/sass/maincontacts.scss', 'public/css')
    .mergeManifest();
