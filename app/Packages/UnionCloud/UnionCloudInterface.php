<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 03/02/19
 * Time: 19:23
 */

namespace App\Packages\UnionCloud;


interface UnionCloudInterface
{
    public function getNameByUID($uid);

    public function getStudentIDByUID($uid);

    public function getAccountSearchDetails($q);
}