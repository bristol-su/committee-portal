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

Breadcrumbs::for('groupinfo.user', function(BreadcrumbsGenerator $trail) {
    $trail->parent('portal');
    $trail->push('Group Information', route('groupinfo.user'));
});

Breadcrumbs::for('groupinfo.admin', function(BreadcrumbsGenerator $trail) {
    $trail->parent('admin');
    $trail->push('Group Information', route('groupinfo.admin'));
});