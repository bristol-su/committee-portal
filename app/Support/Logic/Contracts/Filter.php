<?php

namespace App\Support\Logic\Contracts;

interface Filter
{

    /**
     * Get the user friendly name for the filter
     *
     * @return string
     */
    public static function name() : string;

    /**
     * Get the user friendly description for the filter
     *
     * @return string
     */
    public static function description() : string;

    /**
     * Define who the filter is valid for
     *
     * This can be one of group, role or user
     *
     * @return string
     */
    public function validFor(): string;

    /**
     * Get possible options as an array
     *
     * @return array
     */
    public function options() : array;

    /**
     * Test if the filter passes
     *
     * @param Object $model Group, Role or User
     * @param string $settings Key of the chosen option
     *
     * @return bool
     */
    public function evaluate($model, $settings) : bool;
}