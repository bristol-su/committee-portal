<?php

use \DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;
use \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Breadcrumbs::for('portal', function(BreadcrumbsGenerator $trail) {
    $trail->push('Portal', route('portal'));
});

Breadcrumbs::for('admin', function(BreadcrumbsGenerator $trail) {
    $trail->push('Dashboard', route('admin'));
});

Breadcrumbs::for('admin.settings', function(BreadcrumbsGenerator $trail) {
    $trail->parent('admin');
    $trail->push('Settings', route('admin.settings'));
});
Breadcrumbs::for('admin.settings.users', function(BreadcrumbsGenerator $trail) {
    $trail->parent('admin.settings');
    $trail->push('Users', route('admin.settings.users'));
});
Breadcrumbs::for('admin.settings.roles-permissions', function(BreadcrumbsGenerator $trail) {
    $trail->parent('admin.settings');
    $trail->push('Roles & Permissions', route('admin.settings.roles-permissions'));
});
