const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');


mix.js(__dirname + '/Resources/assets/js/equipmentlist.js', 'public/js')
    .sass(__dirname + '/Resources/assets/sass/equipmentlist.scss', 'public/css')
    .mergeManifest();
