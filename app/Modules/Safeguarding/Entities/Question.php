<?php

namespace App\Modules\Safeguarding\Entities;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'safeguarding_questions';

    protected $fillable = [];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
