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

Breadcrumbs::for('riskassessment.user', function(BreadcrumbsGenerator $trail) {
    $trail->parent('portal');
    $trail->push('Risk Assessment', route('riskassessment.user'));
});

Breadcrumbs::for('riskassessment.admin', function(BreadcrumbsGenerator $trail) {
    $trail->parent('admin');
    $trail->push('Risk Assessment', route('riskassessment.admin'));
});

Breadcrumbs::for('riskassessment.admin.note-template', function(BreadcrumbsGenerator $trail) {
    $trail->parent('riskassessment.admin');
    $trail->push('Risk Assessment Note Templates', route('riskassessment.admin.note-template'));
});