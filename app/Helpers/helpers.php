<?php

if (!function_exists('getReaffiliationYear')) {
    function getReaffiliationYear()
    {
        return config('portal.reaffiliation_year');
    }
}

if (!function_exists('getGroupType')) {
    function getGroupType()
    {
        abort_if(request()->get('auth_group_tags') === null, 403, 'Could not find your group tag.');
        $groupTags = request()->get('auth_group_tags');
        $groupTags->filter(function ($groupTag) {
            return $groupTag->category->reference === config('control.group_type_tag_category_reference');
        });

        return ($groupTags->first() !== null ? $groupTags->first()->reference : false);
    }
}


if (!function_exists('getModuleConfiguration')) {

    function getModuleConfiguration()
    {
        $rawModules = collect(\Nwidart\Modules\Facades\Module::getOrdered())->filter(function ($module) {
            return $module->active === 1;
        });
        $configuration = new \Illuminate\Support\Collection();
        foreach ($rawModules as $rawModule) {
            if (!class_exists($rawModule->dynamic_configuration)) {
                throw new \Exception('Please define a dynamic_configuration property in module ' . $rawModule->getName());
            }

            $moduleConfig = (new $rawModule->dynamic_configuration)->getConfiguration();
            $moduleConfig['rawModule'] = $rawModule;
            $configuration->push($moduleConfig);
        }
        return $configuration;

    }

}

if (!function_exists('getGroupID')) {
    function getGroupID()
    {
        return \Illuminate\Support\Facades\Auth::user()->getCurrentRole()->group->id;
    }
}

if(!function_exists('serveStatic')) {
    function serveStatic($filename)
    {
            return 'https://'
                .config('filesystems.static_content.url').'/'
                .config('filesystems.static_content.bucket').'/'
                .config('filesystems.static_content.folder').'/'.$filename;
    }
}