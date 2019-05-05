<?php


namespace App\Traits;


use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Nwidart\Modules\Facades\Module;

trait OverridesGates
{

    /**
     * Checks the following:
     *  - Module not in the $except array
     *  - isActive permission
     *  - User isn't admin
     *  - Not complete
     * @param string $module
     * @param array $excepts
     */
    public function disableExcept($module, $excepts = [])
    {
        Gate::before(function(User $user, $ability) use ($excepts, $module) {
            if($this->isFromAllowedModule($ability, $excepts) &&
                preg_match('/^.*module.isActive$/', $ability) === 1
                && !$this->userPasses($user)
                && !$this->complete($module)) {
                return false;
            }
        });
    }

    public function userPasses($user)
    {
        return $user->isAdmin();
    }

    public function isFromAllowedModule($ability, $excepts)
    {
        return preg_match('/^(?!' . implode('|', $excepts) . ').*$/', $ability) === 1;
    }

    public function complete($module)
    {
        $configString = Module::find($module)->get('dynamic_configuration');
        $configuration = new $configString;
        return $configuration->isComplete(Auth::user()->getCurrentRole()->group);
    }

}