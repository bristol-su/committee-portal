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

Breadcrumbs::for('wabbudget.user', function(BreadcrumbsGenerator $trail) {
    $trail->parent('portal');
    $trail->push('#WeAreBristol Budget', route('wabbudget.user'));
});

Breadcrumbs::for('wabbudget.admin', function(BreadcrumbsGenerator $trail) {
    $trail->parent('admin');
    $trail->push('#WeAreBristol Budget', route('wabbudget.admin'));
});

Breadcrumbs::for('wabbudget.admin.note-template', function(BreadcrumbsGenerator $trail) {
    $trail->parent('wabbudget.admin');
    $trail->push('#WeAreBristol Budget Note Templates', route('wabbudget.admin.note-template'));
});