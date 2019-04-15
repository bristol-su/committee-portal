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

Breadcrumbs::for('constitution.user', function(BreadcrumbsGenerator $trail) {
    $trail->parent('portal');
    $trail->push('Constitution', route('constitution.user'));
});

Breadcrumbs::for('constitution.admin', function(BreadcrumbsGenerator $trail) {
    $trail->parent('admin');
    $trail->push('Constitution', route('constitution.admin'));
});

Breadcrumbs::for('constitution.admin.note-template', function(BreadcrumbsGenerator $trail) {
    $trail->parent('constitution.admin');
    $trail->push('Constitution Note Templates', route('constitution.admin.note-template'));
});