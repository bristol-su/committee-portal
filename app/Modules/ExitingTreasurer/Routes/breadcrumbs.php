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

Breadcrumbs::for('exitingtreasurer.user', function(BreadcrumbsGenerator $trail) {
    $trail->parent('portal');
    $trail->push('Treasurer Sign-Off', route('exitingtreasurer.user'));
});

Breadcrumbs::for('exitingtreasurer.admin', function(BreadcrumbsGenerator $trail) {
    $trail->parent('admin');
    $trail->push('Treasurer Sign-Off', route('exitingtreasurer.admin'));
});
