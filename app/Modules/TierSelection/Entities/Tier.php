<?php

namespace App\Modules\TierSelection\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tier extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    protected $table = 'tierselection_tiers';

}
