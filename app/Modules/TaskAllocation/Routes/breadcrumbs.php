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

Breadcrumbs::for('taskallocation.user', function(BreadcrumbsGenerator $trail) {
    $trail->parent('portal');
    $trail->push('Task Allocation', route('taskallocation.user'));
});

Breadcrumbs::for('taskallocation.admin', function(BreadcrumbsGenerator $trail) {
    $trail->parent('admin');
    $trail->push('Task Allocation', route('taskallocation.admin'));
});
