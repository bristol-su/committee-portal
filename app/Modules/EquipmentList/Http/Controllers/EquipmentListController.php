<?php

namespace App\Modules\EquipmentList\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EquipmentListController extends Controller
{
    public function showUserPage()
    {
        $this->authorize('equipmentlist.view');

        return view('equipmentlist::equipmentlist');
    }

    public function showAdminPage()
    {
        $this->authorize('equipmentlist.view-admin');

        return view('equipmentlist::admin');
    }

}
