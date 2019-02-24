<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 12/02/19
 * Time: 22:02
 */

namespace App\Packages\ControlDB\Models;

use App\Packages\ControlDB\Models\BaseControlActiveRecordModel as Model;

class StudentTag extends Model
{

    protected $resourceName = 'student_tags';

    protected function category($data) {
        return $this->includesOne(StudentTagCategory::class, $data);
    }
}