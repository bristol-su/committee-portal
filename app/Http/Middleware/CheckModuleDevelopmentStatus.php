<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nwidart\Modules\Facades\Module;

class CheckModuleDevelopmentStatus
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $moduleName)
    {
        // Find the module
        $module = Module::find($moduleName);

        // If the module is in development status and we are not a developer
        if ($module->json()->in_development && !Auth::user()->can('bypass-maintenance') && !app()->isLocal()) {

            $data = [
                'name' => $module->name,
                'description' => (new $module->dynamic_configuration)->getConfiguration()['description']
            ];

            return response(view('modules.in_development')->with($data));
        };
        return $next($request);
    }

}
