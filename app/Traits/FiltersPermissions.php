<?php


namespace App\Traits;


trait FiltersPermissions
{

    /*
    |--------------------------------------------------------------------------
    | Helper Functions
    |--------------------------------------------------------------------------
    |
    | Some helper functions for this trait
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Grouped Functions
    |--------------------------------------------------------------------------
    |
    | These call mutliple checks but contain very little logic
    |
    */


    /*
    |--------------------------------------------------------------------------
    | Checks
    |--------------------------------------------------------------------------
    |
    | Checks on various bits of information given an ability
    |
    */

    /**
     * Is the ability attempting to check viewing a module?
     *
     * @param string $ability
     * @param array $excepts
     *
     * @return bool
     */
    public function overrideIsVisible($ability, $excepts = [])
    {
        return $this->isFromModule($ability, $excepts) &&
            preg_match('/^.*module.isVisible$/', $ability) === 1;

    }

    /**
     * Is the ability attempting to check viewing a module?
     *
     * @param string $ability
     * @param array $excepts
     *
     * @return bool
     */
    public function overrideIsActive($ability, $excepts = [])
    {
        return $this->isFromModule($ability, $excepts) &&
            preg_match('/^.*module.isActive$/', $ability) === 1;

    }

    public function isFromModule($ability, $excepts)
    {
        return preg_match('/^(?!' . implode('|', $excepts) . ').*$/', $ability) === 1;
    }
}