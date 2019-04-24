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

Breadcrumbs::for('strategicplan.user', function(BreadcrumbsGenerator $trail) {
    $trail->parent('portal');
    $trail->push('Strategic Plan', route('strategicplan.user'));
});

Breadcrumbs::for('strategicplan.admin', function(BreadcrumbsGenerator $trail) {
    $trail->parent('admin');
    $trail->push('Strategic Plan', route('strategicplan.admin'));
});

Breadcrumbs::for('strategicplan.admin.note-template', function(BreadcrumbsGenerator $trail) {
    $trail->parent('strategicplan.admin');
    $trail->push('Strategic Plan Note Templates', route('strategicplan.admin.note-template'));
});