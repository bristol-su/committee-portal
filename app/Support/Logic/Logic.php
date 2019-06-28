<?php

namespace App\Support\Logic;

use Illuminate\Database\Eloquent\Model;

class Logic extends Model
{
    protected $fillable = [
        'name',
        'description',
        'for',
        'all_true',
        'any_true',
        'all_false',
        'any_false'
    ];

    protected $casts = [
        'all_true' => 'array',
        'any_true' => 'array',
        'all_false' => 'array',
        'any_false' => 'array'
    ];
    
    public function scopeGroups($query)
    {
        return $query->where('for', 'group');
    }

    public function scopeStudents($query)
    {
        return $query->where('for', 'student');
    }
}
