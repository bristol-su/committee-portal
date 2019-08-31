<?php

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

use App\Modules\FileUpload\Events\DocumentApproved;
use App\Modules\FileUpload\Events\DocumentSubmitted;
use App\Support\Authentication\Contracts\Authentication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

Route::get('/', 'StrategicPlanController@showUserPage');
Route::get('/admin', 'StrategicPlanController@showAdminPage');
Route::get('/submitted', function(Request $request) {
    Event::dispatch(new DocumentSubmitted($request->route('module_instance_slug')->id));
    return back();
});
Route::get('/approved', function(Request $request) {
    Event::dispatch(new DocumentApproved($request->route('module_instance_slug')->id));
    return back();
});
