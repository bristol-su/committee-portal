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

Breadcrumbs::for('furtherinformation.user', function(BreadcrumbsGenerator $trail) {
    $trail->parent('portal');
    $trail->push('Further Information', route('furtherinformation.user'));
});

Breadcrumbs::for('furtherinformation.admin', function(BreadcrumbsGenerator $trail) {
    $trail->parent('admin');
    $trail->push('Further Information', route('furtherinformation.admin'));
});