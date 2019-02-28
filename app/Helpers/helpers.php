<?php

if (!function_exists('getReaffiliationYear')) {
    function getReaffiliationYear()
    {
        return config('portal.reaffiliation_year');
    }
}

if (!function_exists('getTagReference')) {
    function getTagReference()
    {
        abort_if(request()->get('auth_group_tags') === null, 403, 'Could not find your group tag.');
        $groupTags = request()->get('auth_group_tags');
        $groupTags->filter(function ($groupTag) {
            return $groupTag->category->reference === config('control.group_type_tag_category_reference');
        });

        return ($groupTags->first() !== null ? $groupTags->first()->reference : false);
    }
}