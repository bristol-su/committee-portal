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
        return [
            'alias' => $this->alias,
            'completion' => $this->completion
        ];
    }

}