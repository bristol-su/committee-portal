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

        return User::with(['permissions', 'roles'])->get()->filter(function ($user) {
            return $user->isAdmin();
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

        return Permission::get(['name', 'id']);
    }

    public function getRoles()
    {
        $this->authorize('settings.see-manage-admin-permissions');

        return Role::with('permissions:id,name')->get(['name', 'id']);

    }
}
