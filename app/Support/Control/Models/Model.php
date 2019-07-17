<?php


namespace App\Support\Control\Models;


use Illuminate\Database\Eloquent\Concerns\HasAttributes;

class Model
{
    protected $attributes;

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    public function __get($name)
    {
        if(isset($this->attributes[$name])) {
            return $this->attributes[$name];
        }

        return null;
    }

}