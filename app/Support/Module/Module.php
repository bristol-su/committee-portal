<?php

namespace App\Support\Module\Module;

use Illuminate\Contracts\Support\Arrayable;

class Module implements Arrayable
{

    private $alias;

    public $completion;

    public function __construct($alias)
    {
        $this->alias = $alias;
    }

    public function alias()
    {
        return $this->alias;
    }

    public function toArray()
    {
        // TODO Refactor config out

        return array_merge([
            'alias' => $this->alias,
        ], config($this->alias));
    }

}
