<?php

namespace App\Modules\ExitingTreasurer\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'exitingtreasurer_documents';

    protected $fillable = [
        'year',
        'title',
        'filename',
        'mime',
        'path',
        'size',
        'type',
        'uploaded',
        'group_id',
        'uploaded_by'
    ];

    protected $casts = [
        'uploaded' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
