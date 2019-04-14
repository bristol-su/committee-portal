<?php


namespace App\Traits;


use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\UnionCloud\UnionCloud;

trait GetsEmailFromRole
{

    public function email(CommitteeRole $role)
    {
        $uid = $role->student->uc_uid;
        return resolve(UnionCloud::class)->getStudentByUid()->email;
    }

}