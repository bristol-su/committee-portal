<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 12/02/19
 * Time: 22:01
 */

namespace App\Packages\ControlDB\Models;


use ActiveResource\Model;

class BaseControlActiveRecordModel extends Model
{
    protected $connectionName = 'control';
}