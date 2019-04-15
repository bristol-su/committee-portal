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

Breadcrumbs::for('presidenthandover.user', function(BreadcrumbsGenerator $trail) {
    $trail->parent('portal');
    $trail->push('Your Successor', route('presidenthandover.user'));
});

Breadcrumbs::for('presidenthandover.admin', function(BreadcrumbsGenerator $trail) {
    $trail->parent('admin');
    $trail->push('Your Successor', route('presidenthandover.admin'));
});