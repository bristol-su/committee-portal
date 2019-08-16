<?php


namespace App\Support\Filters\Contracts\Filters;


interface Filter
{

    /**
     * Get possible options as an array
     *
     * @return array
     */
    public function options(): array;

    /**
     * Test if the filter passes
     *
     * @param Object $model Group, Role or User
     * @param string $settings Key of the chosen option
     *
     * @return bool
     */
    public function evaluate($settings): bool;

    public function name();

    public function description();

    public function for();

}
