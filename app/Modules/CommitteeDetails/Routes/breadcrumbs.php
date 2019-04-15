<?php

use \DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;
use \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

/*
|--------------------------------------------------------------------------
| Breadcrumbs
|--------------------------------------------------------------------------
|
| Registration for breadcrumbs may occur in here
|
*/

Breadcrumbs::for('committeedetails.user', function(BreadcrumbsGenerator $trail) {
    $trail->parent('portal');
    $trail->push('Committee Details', route('committeedetails.user'));
});

Breadcrumbs::for('committeedetails.admin', function(BreadcrumbsGenerator $trail) {
    $trail->parent('admin');
    $trail->push('Committee Details', route('committeedetails.admin'));
});



