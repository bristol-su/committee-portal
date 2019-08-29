<?php

namespace App\Support\Control\Models;

use Illuminate\Contracts\Support\Arrayable;

class Model implements Arrayable
{
    protected $attributes;

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    public function __get($name)
    {
        if(!is_array($this->attributes)) {
            dd($this->attributes, $name);
        }
        if(isset($this->attributes[$name])) {
            return $this->attributes[$name];
        }

        return null;
    }

    public function toArray()
    {
        return $this->attributes;
    }

}
