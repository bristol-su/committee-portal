<?php

namespace App\Modules\EquipmentList\Entities;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{

    protected $table = 'equipmentlist_submissions';

    protected $fillable = [
        'group_id',
        'user_id',
        'position_id',
        'year'
    ];
}