<?php

namespace App\Packages\ControlDB\Models;

use App\Packages\ControlDB\Models\BaseControlActiveRecordModel as Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Log;

class Position extends Model
{

    protected $resourceName = 'positions';

    public function __toString()
    {
       return json_encode([
           'value' => $this->id,
           'label' => $this->name
       ]);
    }
}
