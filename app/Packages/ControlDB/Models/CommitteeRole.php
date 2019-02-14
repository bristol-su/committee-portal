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
        // TODO: Implement getAuthIdentifier() method.
    }

    public function getAuthPassword()
    {
        return $this->student_id;
        // TODO: Implement getAuthPassword() method.
    }

    public function getRememberToken()
    {
        // TODO: Implement getRememberToken() method.
    }

    public function setRememberToken($value)
    {
        // TODO: Implement setRememberToken() method.
    }

    public function getRememberTokenName()
    {
        // TODO: Implement getRememberTokenName() method.
    }

    public function getAuthIdentifierName()
    {
        return 'id';
        // TODO: Implement getAuthIdentifierName() method.
    }

    public function group($data) {
        return $this->includesOne(Group::class, $data);
    }

    public function position($data) {
        return $this->includesOne(Position::class, $data);
    }

}
