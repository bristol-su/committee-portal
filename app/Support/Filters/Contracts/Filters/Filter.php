<?php


namespace App\Support\Filters\Contracts\Filters;


use Illuminate\Contracts\Support\Arrayable;

abstract class Filter implements Arrayable
{

    /**
     * Get possible options as an array
     *
     * @return array
     */
    abstract public function options(): array;

    /**
     * Test if the filter passes
     *
     * @param Object $model Group, Role or User
     * @param string $settings Key of the chosen option
     *
     * @return bool
     */
    abstract public function evaluate($settings): bool;

    abstract public function name();

    abstract public function description();

    abstract public function for();

    abstract public function alias();

    public function toArray()
    {
        return [
            'alias' => $this->alias(),
            'name' => $this->name(),
            'description' => $this->description(),
            'for' => $this->for(),
            'options' => $this->options()
        ];
    }


}
