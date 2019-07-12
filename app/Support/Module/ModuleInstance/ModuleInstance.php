<?php

namespace App\Support\Module\ModuleInstance;

use App\Support\Event\Event;
use App\Support\Module\Contracts\ModuleInstance as ModuleInstanceContract;
use App\Support\Module\Module\Permissions\ModuleInstancePermissions;
use App\Support\Module\Registration\OverrideAttribute;
use App\Support\Module\Settings\ModuleInstanceSettings;
use Illuminate\Database\Eloquent\Model;

class ModuleInstance extends Model implements ModuleInstanceContract
{

    protected $fillable = [
        'alias',
        'event_id',
        'name',
        'description',
        'active',
        'visible',
        'mandatory',
        'complete'
    ];

    public function alias()
    {
        return $this->alias;
    }

    public function id()
    {
        return $this->id;
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function moduleInstanceSettings()
    {
        return $this->belongsTo(ModuleInstanceSettings::class);
    }

    public function moduleInstancePermissions()
    {
        return $this->belongsTo(ModuleInstancePermissions::class);
    }

}
