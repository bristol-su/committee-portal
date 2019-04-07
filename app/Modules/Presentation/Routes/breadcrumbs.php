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

Breadcrumbs::for('presentation.user', function(BreadcrumbsGenerator $trail) {
    $trail->parent('portal');
    $trail->push('Presentation', route('presentation.user'));
});

Breadcrumbs::for('presentation.admin', function(BreadcrumbsGenerator $trail) {
    $trail->parent('admin');
    $trail->push('Presentation', route('presentation.admin'));
});

Breadcrumbs::for('presentation.admin.note-template', function(BreadcrumbsGenerator $trail) {
    $trail->parent('presentation.admin');
    $trail->push('Presentation Note Templates', route('presentation.admin.note-template'));
});