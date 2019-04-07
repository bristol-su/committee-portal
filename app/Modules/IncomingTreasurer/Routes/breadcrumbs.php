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

Breadcrumbs::for('incomingtreasurer.user', function(BreadcrumbsGenerator $trail) {
    $trail->parent('portal');
    $trail->push('Treasurer Training', route('incomingtreasurer.user'));
});

Breadcrumbs::for('incomingtreasurer.admin', function(BreadcrumbsGenerator $trail) {
    $trail->parent('admin');
    $trail->push('Treasurer Training', route('incomingtreasurer.admin'));
});