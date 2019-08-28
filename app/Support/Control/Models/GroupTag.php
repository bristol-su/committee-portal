<?php

namespace App\Support\Control\Models;

use App\Support\Control\Contracts\Models\GroupTag as GroupTagContract;

class GroupTag extends Model implements GroupTagContract
{

    public function name()
    {
        return $this->attributes['name'];
    }

    public function fullReference()
    {
        return $this->attributes['category']['reference'].'.'.$this->attributes['reference'];
    }
}
