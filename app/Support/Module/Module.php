<?php

namespace App\Support\Module;

use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Contracts\Support\Arrayable;

class Module implements Arrayable
{

    private $alias;

    public $completion;
    /**
     * @var ConfigRepository
     */
    private $config;

    public function __construct($alias, ConfigRepository $config)
    {
        $this->alias = $alias;
        $this->config = $config;
    }

    public function alias()
    {
        return $this->alias;
    }

    public function toArray()
    {
        // TODO Refactor config out

        return array_merge(
            ['alias' => $this->alias,],
            $this->config->get($this->alias, [])
        );

    }

}
