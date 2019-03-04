<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 03/03/19
 * Time: 19:01
 */

namespace App\Authentication;

use App\Packages\ControlDB\Models\Group;
use Illuminate\Contracts\Auth\Authenticatable;

class ViewAsStudent implements Authenticatable
{
    public $position = null;

    public $group = null;

    public function __construct($groupID)
    {
        $this->position = (object)[
            'id' => 'admin',
            'name' => 'Administrator'
        ];

        $this->group = Group::find($groupID);
    }

    public function getAuthIdentifier()
    {
        return $this->group->id;
    }

    public function getAuthIdentifierName()
    {
        return 'group_id';
    }

    public function getAuthPassword()
    {
        return '';
    }

    public function getRememberToken()
    {
    }

    public function getRememberTokenName()
    {
    }

    public function setRememberToken($value)
    {
        //
    }
}