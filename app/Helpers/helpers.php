<?php

if(!function_exists('moduleUrl')) {
    function moduleUrl($path, $admin=false) {
        return url(
            request('activity_slug')->slug .
            '/' .
            request('module_instance_slug')->slug .
            ($admin?'/admin/':'/') .
            $path
        );
    }
}

if (!function_exists('serveStatic')) {
    function serveStatic($filename)
    {
            return 'https://'
                .config('filesystems.static_content.url').'/'
                .config('filesystems.static_content.bucket').'/'
                .config('filesystems.static_content.folder').'/'.$filename;
    }
}
