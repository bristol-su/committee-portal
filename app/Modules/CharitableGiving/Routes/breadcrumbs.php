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

Breadcrumbs::for('charitablegiving.user', function(BreadcrumbsGenerator $trail) {
    $trail->parent('portal');
    $trail->push('Charitable Giving', route('charitablegiving.user'));
});

Breadcrumbs::for('charitablegiving.admin', function(BreadcrumbsGenerator $trail) {
    $trail->parent('admin');
    $trail->push('Charitable Giving', route('charitablegiving.admin'));
});