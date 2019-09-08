<?php


namespace App\Support\Permissions\Contracts;


use App\Support\Permissions\Contracts\Models\Permission;

interface PermissionRepository
{

    public function get(string $ability): Permission;

    public function forModule(string $alias): array;
}
