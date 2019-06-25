<?php

namespace App\Support\Module\Registration;

use App\Support\Module\Contracts\OverrideAttribute as OverrideAttributeContract;
use App\Support\Module\ModuleInstance\ModuleInstance;
use Illuminate\Database\Eloquent\Model;

class OverrideAttribute extends Model implements OverrideAttributeContract
{
    protected $fillable = [
        'attributes'
    ];

    protected $casts = [
        'attributes' => 'array'
    ];

    public function moduleInstance()
    {
        return $this->belongsTo(ModuleInstance::class);
    }
}
