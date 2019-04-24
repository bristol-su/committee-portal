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

Breadcrumbs::for('budget.user', function(BreadcrumbsGenerator $trail) {
    $trail->parent('portal');
    $trail->push('Annual Budget', route('budget.user'));
});

Breadcrumbs::for('budget.admin', function(BreadcrumbsGenerator $trail) {
    $trail->parent('admin');
    $trail->push('Annual Budget', route('budget.admin'));
});

Breadcrumbs::for('budget.admin.note-template', function(BreadcrumbsGenerator $trail) {
    $trail->parent('budget.admin');
    $trail->push('Annual Budget Note Templates', route('budget.admin.note-template'));
});