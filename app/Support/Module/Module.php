<?php

namespace App\Support\Module;

use App\Support\Completion\Contracts\CompletionEventRepository;
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

    public function __construct($alias, ConfigRepository $config, CompletionEventRepository $completion)
    {
        $this->alias = $alias;
        $this->config = $config;
        $this->completion = $completion;
    }

    public function alias()
    {
        return $this->alias;
    }

    public function toArray()
    {
        // TODO Refactor config out

        return array_merge(
            $this->config->get($this->alias, []),
            [
                'alias' => $this->alias,
                'completion' => $this->completion->allForModule($this->alias)
            ]
        );

    }

}
