<?php

namespace App\Support\Permissions\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ModelPermission extends Model
{

    protected $table = 'model_permissions';

    protected $fillable = [
        'ability',
        'model',
        'model_id',
        'result'
    ];

    protected $casts = [
        'result' => 'boolean'
    ];

    public function scopeUser(Builder $query, $userId = null, $ability = null)
    {
        $constraints = ['model' => 'user'];
        if($userId !== null) {
            $constraints['model_id'] = $userId;
        }
        if($ability !== null) {
            $constraints['ability'] = $ability;
        }
        return $query->where($constraints);
    }

    public function scopeLogic(Builder $query, $logicId = null, $ability = null)
    {
        $constraints = ['model' => 'logic'];
        if($logicId !== null) {
            $constraints['model_id'] = $logicId;
        }
        if($ability !== null) {
            $constraints['ability'] = $ability;
        }
        return $query->where($constraints);
    }

    public function scopeGroup(Builder $query, $groupId = null, $ability = null)
    {
        $constraints = ['model' => 'group'];
        if($groupId !== null) {
            $constraints['model_id'] = $groupId;
        }
        if($ability !== null) {
            $constraints['ability'] = $ability;
        }
        return $query->where($constraints);
    }
}
