<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 08/02/19
 * Time: 13:23
 */

namespace App\Packages\GoogleDrive;


class GoogleDriveAdapter extends \Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter
{
    public function getService()
    {
        return $this->service;
    }
}