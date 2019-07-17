<?php

namespace App\Support\Module\ModuleInstance;

use App\Support\Event\Event;
use App\Support\Logic\Logic;
use App\Support\Module\Contracts\ModuleInstance as ModuleInstanceContract;
use App\Support\Module\Module\Permissions\ModuleInstancePermissions;
use App\Support\Module\Registration\OverrideAttribute;
use App\Support\Module\Settings\ModuleInstanceSettings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::creating(function($model) {
            if($model->slug === null) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

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

    public function activeLogic()
    {
        return $this->belongsTo(Logic::class, 'active');
    }

    public function visibleLogic()
    {
        return $this->belongsTo(Logic::class, 'visible');
    }

    public function mandatoryLogic()
    {
        return $this->belongsTo(Logic::class, 'mandatory');
    }

}
