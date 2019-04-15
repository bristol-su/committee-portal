<?php

namespace App\Modules\ExitingTreasurer\Entities;

use Illuminate\Database\Eloquent\Model;

class NoteTemplate extends Model
{
    protected $fillable = [
        'name',
        'description',
        'template'
    ];

    protected $table = 'exitingtreasurer_note_templates';
}
