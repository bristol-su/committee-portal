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

Breadcrumbs::for('maincontacts.user', function(BreadcrumbsGenerator $trail) {
    $trail->parent('portal');
    $trail->push('Notification Contacts', route('maincontacts.user'));
});

Breadcrumbs::for('maincontacts.admin', function(BreadcrumbsGenerator $trail) {
    $trail->parent('admin');
    $trail->push('Notification Contacts', route('maincontacts.admin'));
});