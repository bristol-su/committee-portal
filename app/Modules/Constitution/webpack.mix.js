const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');


mix.js(__dirname + '/Resources/assets/js/constitution.js', 'public/js')
    .sass(__dirname + '/Resources/assets/sass/constitution.scss', 'public/css')
    .mergeManifest();
