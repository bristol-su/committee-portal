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

Breadcrumbs::for('equipmentlist.user', function(BreadcrumbsGenerator $trail) {
    $trail->parent('portal');
    $trail->push('Equipment List', route('equipmentlist.user'));
});

Breadcrumbs::for('equipmentlist.admin', function(BreadcrumbsGenerator $trail) {
    $trail->parent('admin');
    $trail->push('Equipment List', route('constitution.equipmentlist'));
});