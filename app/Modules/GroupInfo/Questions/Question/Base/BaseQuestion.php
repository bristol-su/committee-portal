<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 23/03/19
 * Time: 14:38
 */

namespace App\Modules\GroupInfo\Questions\Question\Base;


use App\Packages\ControlDB\Models\Group;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Log;

// TODO Extract this to a database

abstract class BaseQuestion implements Arrayable
{
    abstract public function name();

    abstract public function identity();

    abstract public function helpText();

    abstract public function type();

    abstract public function required();

    abstract public function configuration();

    abstract public function getAnswer(Group $group);

    /**
     * @return string
     */
    abstract public function job();

    public function html()
    {
        return view('groupinfo::questions.question.'.$this->identity());
    }

    public function toArray()
    {
        return [
            'type' => $this->type(),
            'name' => $this->name(),
            'helpText' => $this->helpText(),
            'identity' => $this->identity(),
            'required' => $this->required(),
            'configuration' => $this->configuration()
        ];
    }

    public function dispatchJob($data)
    {
        ($this->job())::dispatch($data);
    }
}