<?php

namespace App\Packages\ControlDB\Models;

use App\Packages\ControlDB\Models\BaseControlActiveRecordModel as Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Log;

class CommitteeRole extends Model implements Authenticatable
{

    protected $resourceName = 'position_student_groups';

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getAuthPassword()
    {
        return $this->student_id;
    }

    public function getRememberToken()
    {
    }

    public function setRememberToken($value)
    {
    }

    public function getRememberTokenName()
    {
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function group($data) {
        return $this->includesOne(Group::class, $data);
    }

    public function position($data) {
        return $this->includesOne(Position::class, $data);
    }

    public function student($data) {
        return $this->includesOne(Student::class, $data);
    }

}
