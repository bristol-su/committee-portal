<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSettingsController extends Controller
{

    public function showSettingsPage()
    {
        $this->authorize('view-site-settings-page');

        return view('admin.settings');
    }

    public function showAdminUsersPage()
    {
        $this->authorize('settings.see-all-admin-users');

        return view('admin.settings.admin_users');
    }

    public function getAdminUsers()
    {
        $this->authorize('settings.see-all-admin-users');

        return User::with(['roles:id,name', 'permissions:id,name'])->get()->filter(function ($user) {
            return $user->isAdmin();
        })->each(function (&$user) {
            $user->roles->each(function($role) {
                $role->load('permissions:id,name');
                $role->permissions->makeHidden('pivot');
            });
            $user->roles->makeHidden('pivot');
            $user->permissions->makeHidden('pivot');
        })->values();

    }

    public function deleteAdminUsers(User $user)
    {
        $this->authorize('settings.delete-admin-user');

        abort_if(!$user->isAdmin(), 400, 'Can only delete admin users');

        $user->delete();
    }

    public function getPermissions()
    {
        $this->authorize('settings.see-manage-admin-permissions');

        return Permission::get(['id', 'name']);
    }

    public function getRoles()
    {
        $this->authorize('settings.see-manage-admin-permissions');

        return Role::with('permissions:id,name')->get(['id', 'name'])->each(function (&$role) {
            $role->permissions->makeHidden('pivot');
        });

    }

    public function updateRolesAndPermissions(User $user, Request $request)
    {
        $this->authorize('settings.update-admin-permissions');

        $request->validate([
            'permissions' => 'sometimes|array',
            'permissions.*' => 'exists:permissions,id',
            'roles' => 'sometimes|array',
            'roles.*' => 'exists:roles,id',
        ]);

        if($user->permissions()->sync($request->input('permissions')) && $user->roles()->sync($request->input('roles'))){
            return response('', 200);
        }
    }
}
