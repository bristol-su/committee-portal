<?php

namespace App\Modules\MainContacts\Entities;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = 'maincontacts_submissions';

    protected $fillable = [
        'user_id',
        'group_id',
        'year'
    ];
}
