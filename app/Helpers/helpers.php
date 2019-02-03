<?php

if( !function_exists('getReaffiliationYear'))
{
    function getReaffiliationYear()
    {
        return config('portal.reaffiliation_year');
    }
}