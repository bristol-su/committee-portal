<?php

namespace App\Support\Activity;

use App\Support\Activity\Contracts\Repository as ActivityRepositoryContract;
use App\Support\Logic\Facade\LogicTester;

class Repository implements ActivityRepositoryContract
{
    public function active()
    {
        return Activity::active()->with([
            'moduleInstances',
            'forLogic',
            'adminLogic',
            'moduleInstances.activeLogic',
            'moduleInstances.visibleLogic',
            'moduleInstances.mandatoryLogic',
        ])->get();
    }

    public function getForAdministrator()
    {
        return $this->active()->filter(function($activity) {
            return LogicTester::evaluate($activity->adminLogic);
        });
    }

    public function getForParticipant()
    {
        return $this->active()->filter(function($activity) {
            return LogicTester::evaluate($activity->forLogic);
        });
    }

    public function all()
    {
        return Activity::all();
    }

    public function create(array $attributes)
    {
        return Activity::create($attributes);
    }
}
