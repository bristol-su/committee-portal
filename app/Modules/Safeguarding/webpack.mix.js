const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');


mix.js(__dirname + '/Resources/assets/js/safeguarding.js', 'public/js')
    .sass(__dirname + '/Resources/assets/sass/safeguarding.scss', 'public/css')
    .mergeManifest();
