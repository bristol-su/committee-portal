<?php

namespace App\Modules\EquipmentList\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{

    use SoftDeletes;

    protected $table = 'equipmentlist_equipment';

    protected $fillable = [
        'user_id',
        'group_id',
        'name',
        'description',
        'category',
        'price',
        'notes',
        'bought_at',
        'deleted_reason',
    ];

    protected $dates = [
        'bought_at'
    ];
}
