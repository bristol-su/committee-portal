const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');


mix.js(__dirname + '/Resources/assets/js/groupinfo.js', 'public/js')
    .sass(__dirname + '/Resources/assets/sass/groupinfo.scss', 'public/css')
    .mergeManifest();
