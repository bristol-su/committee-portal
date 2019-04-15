<?php

namespace App\Modules\TaskAllocation\Providers;

use App\Modules\TaskAllocation\Entities\Task;
use App\Packages\ControlDB\Models\Student;
use App\Packages\ControlDB\Models\StudentTag;
use App\Traits\AuthorizesUsers;
use App\Traits\OverridesGates;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    use AuthorizesUsers, OverridesGates;

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Get things people can be responsible for
     */
    public function getResponsibilities(User $user)
    {
        $student = Student::find($user->getControlID());
        $studentTags = StudentTag::allThrough($student);
        if($studentTags === false) {
            return [];
        }
        $group = Auth::user()->getCurrentRole()->group;
        $responsibilities = $studentTags->filter(function(StudentTag $tag) use ($group) {
            $data = json_decode($tag->pivot->data);
            if(property_exists($data, 'group_id')) {
                if($data->group_id === $group->id) {
                    return $tag->category->reference === 'task_allocations';
                }
            }
            return false;
        });
        return $responsibilities;
    }

     /**
     * Register the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->disableExcept('TaskAllocation', ['groupinfo', 'committeedetails', 'incomingtreasurer', 'budget', 'taskallocation', 'presidenthandover', 'exitingtreasurer', 'committeedetails']);

        // Override permissions if the user is responsible for something
        Gate::before(function(User $user, $ability) {
            if(!Auth::guard('committee-role')->check()) {
                return null;
            }
            $responsibilities = $this->getResponsibilities($user);
            foreach($responsibilities as $responsibility) {
                // The user is responsible for something. Override relevant gates
                $override = [];
                switch ($responsibility->reference) {
                    case 'constitution':
                        $override = [
                            'constitution.reaffiliation.isResponsible',
                            'constitution.upload'
                        ];
                        break;
                    case 'risk_assessment':
                        $override = [
                            'riskassessment.reaffiliation.isResponsible',
                            'riskassessment.upload'
                        ];
                        break;
                    case 'strategic_plan':
                        $override = [
                            'strategicplan.reaffiliation.isResponsible',
                            'strategicplan.upload'
                        ];
                        break;
                    case 'annual_budget':
                        $override = [
                            'budget.reaffiliation.isResponsible',
                            'budget.upload'
                        ];
                        break;
                    case 'equipment_list':
                        $override = [
                            'equipmentlist.submit',
                            'equipmentlist.create-equipment',
                            'equipmentlist.delete-equipment',
                            'equipmentlist.reaffiliation.isResponsible',

                        ];
                        break;
                }
                if(in_array($ability, $override)) {
                    return true;
                }
            }
        });

        Gate::define('taskallocation.module.isVisible', function (User $user) {
            // TODO GATE BEFORE GroupInfo
            // TODO GATE BEFORE CommitteeDetails
            return true;
        });

        Gate::define('taskallocation.module.isActive', function (User $user) {
            // TODO GATE BEFORE GroupInfo
            // TODO GATE BEFORE CommitteeDetails
            return true;
        });

        Gate::define('taskallocation.reaffiliation.isMandatory', function (User $user) {
            return true;
        });


        Gate::define('taskallocation.reaffiliation.isResponsible', function (User $user) {
            return $this->studentHasPresidentialPosition($user)
                && $this->studentIsNewCommittee($user);
        });

        Gate::define('taskallocation.submit', function (User $user) {
            return $this->studentHasPresidentialPosition($user)
                && $this->studentIsNewCommittee($user);
        });

        Gate::define('taskallocation.view', function (User $user) {
            return true;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
