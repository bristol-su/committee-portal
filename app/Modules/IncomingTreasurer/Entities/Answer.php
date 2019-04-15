<?php

namespace App\Modules\IncomingTreasurer\Entities;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'incomingtreasurer_answers';

    protected $casts = [
        'correct' => 'boolean'
    ];
    protected $fillable = [];
}
