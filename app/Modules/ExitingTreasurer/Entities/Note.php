<?php

namespace App\Modules\ExitingTreasurer\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'note'
    ];

    protected $table = 'exitingtreasurer_notes';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
