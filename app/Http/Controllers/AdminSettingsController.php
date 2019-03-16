<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{

    public function showSettingsPage()
    {
        return view('admin.settings');
    }

    public function showAdminUsersPage()
    {
        return view('admin.settings.admin_users');
    }

    public function getAdminUsers()
    {
        $this->authorize('settings.see-all-admin-users');

        return User::all()->filter(function($user) {
            return $user->isAdmin();
        })->values();
    }
}
