<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 12/02/19
 * Time: 22:02
 */

namespace App\Packages\ControlDB\Models;

use App\Packages\ControlDB\Models\BaseControlActiveRecordModel as Model;
use Illuminate\Support\Facades\Log;

class Student extends Model
{

    protected $resourceName = 'students';

    public function parseAll($payload)
    {
        return $payload;
    }

    public function hydrate($data) {
        return parent::hydrate($data);
    }

}