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

Breadcrumbs::for('executivesummary.user', function(BreadcrumbsGenerator $trail) {
    $trail->parent('portal');
    $trail->push('Executive Summary', route('executivesummary.user'));
});

Breadcrumbs::for('executivesummary.admin', function(BreadcrumbsGenerator $trail) {
    $trail->parent('admin');
    $trail->push('Executive Summary', route('executivesummary.admin'));
});

Breadcrumbs::for('executivesummary.admin.note-template', function(BreadcrumbsGenerator $trail) {
    $trail->parent('executivesummary.admin');
    $trail->push('Executive Summary Note Templates', route('executivesummary.admin.note-template'));
});