<?php

namespace App\Modules\TaskAllocation\Entities;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{

    protected $table = 'taskallocation_submissions';

    protected $fillable = [
        'user_id',
        'group_id',
        'year'
    ];

}
