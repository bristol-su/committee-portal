<?php

namespace App\Support\Module\Settings;

use App\Support\Module\ModuleInstance\ModuleInstance;
use Illuminate\Database\Eloquent\Model;

class ModuleInstanceSettings extends Model
{
    protected $casts = [
        'settings' => 'array'
    ];

    protected $fillable = [
        'settings'
    ];

    public function moduleInstance()
    {
        return $this->hasOne(ModuleInstance::class);
    }
}
