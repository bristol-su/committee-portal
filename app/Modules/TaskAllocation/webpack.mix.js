const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');


mix.js(__dirname + '/Resources/assets/js/taskallocation.js', 'public/js')
    .sass(__dirname + '/Resources/assets/sass/taskallocation.scss', 'public/css')
    .mergeManifest();
