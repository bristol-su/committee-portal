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

Breadcrumbs::for('gdpr.user', function(BreadcrumbsGenerator $trail) {
    $trail->parent('portal');
    $trail->push('GDPR', route('gdpr.user'));
});

Breadcrumbs::for('gdpr.admin', function(BreadcrumbsGenerator $trail) {
    $trail->parent('admin');
    $trail->push('GDPR', route('gdpr.admin'));
});