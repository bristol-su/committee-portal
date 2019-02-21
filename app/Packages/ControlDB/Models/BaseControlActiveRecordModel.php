<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 12/02/19
 * Time: 22:01
 */

namespace App\Packages\ControlDB\Models;


use ActiveResource\Model;
use Illuminate\Contracts\Support\Jsonable;

class BaseControlActiveRecordModel extends Model implements Jsonable
{
    protected $connectionName = 'control';

    public function __toString()
    {
        return json_encode($this->toArray());
    }

    /**
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }
}