<?php

namespace App\Modules\CommitteeDetails\Policies;

use App\Modules\CommitteeDetails\Entities\Committee;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommitteePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user)
    {
        // TODO Populate Policy
        return $user->isNewCommittee();
    }

    public function create(User $user, Committee $committee)
    {
        // TODO Populate Policy
        return true;
    }

    public function delete(User $user, Committee $committeeMember)
    {
        // TODO Populate Policy
        return true;
    }

    public function upload(User $user)
    {
        // TODO Populate Policy
        return true;
    }
}
