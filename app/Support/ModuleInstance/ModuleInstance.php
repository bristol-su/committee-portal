<?php

namespace App\Support\ModuleInstance;

use App\Support\Activity\Activity;
use App\Support\Logic\Logic;
use App\Support\ModuleInstance\Contracts\ModuleInstance as ModuleInstanceContract;
use App\Support\Permissions\ModuleInstancePermissions;
use App\Support\Module\Settings\ModuleInstanceSettings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ModuleInstance extends Model implements ModuleInstanceContract
{

    protected $fillable = [
        'alias',
        'activity_id',
        'name',
        'slug',
        'description',
        'active',
        'visible',
        'mandatory',
        'complete',
        'module_instance_settings_id',
        'module_instance_permissions_id'
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

    public function activity()
    {
        return $this->belongsTo(Activity::class);
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
