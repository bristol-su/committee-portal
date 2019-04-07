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

Breadcrumbs::for('wabstrategicplan.user', function(BreadcrumbsGenerator $trail) {
    $trail->parent('portal');
    $trail->push('#WeAreBristol Strategic Plan', route('wabstrategicplan.user'));
});

Breadcrumbs::for('wabstrategicplan.admin', function(BreadcrumbsGenerator $trail) {
    $trail->parent('admin');
    $trail->push('#WeAreBristol Strategic Plan', route('wabstrategicplan.admin'));
});

Breadcrumbs::for('wabstrategicplan.admin.note-template', function(BreadcrumbsGenerator $trail) {
    $trail->parent('wabstrategicplan.admin');
    $trail->push('#WeAreBristol Strategic Plan Note Templates', route('budget.admin.note-template'));
});