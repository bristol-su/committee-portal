<?php


namespace App\Support\Control\Repositories;


use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Student;
use App\Support\Control\Repositories\Contracts\Role as RoleContract;
use Illuminate\Support\Collection;

class Role implements RoleContract
{

    public function getById($id)
    {
        $role = CommitteeRole::find($id);
        return new \App\Support\Control\Models\Role($role->toArray());
    }

    public function allFromStudentControlID($id): Collection
    {
        $student = Student::find($id);
        $roles = CommitteeRole::allThrough($student);
        $customRoles = new Collection;
        if($roles === false) {
            return $customRoles;
        }
        foreach($roles as $role) {
            $customRoles->push(new \App\Support\Control\Models\Role($role->toArray()));
        }
        return $customRoles;
    }


}