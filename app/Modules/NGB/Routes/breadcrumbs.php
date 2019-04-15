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

Breadcrumbs::for('ngb.user', function(BreadcrumbsGenerator $trail) {
    $trail->parent('portal');
    $trail->push('NGB', route('ngb.user'));
});

Breadcrumbs::for('ngb.admin', function(BreadcrumbsGenerator $trail) {
    $trail->parent('admin');
    $trail->push('NGB', route('ngb.admin'));
});