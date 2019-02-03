<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 03/02/19
 * Time: 19:23
 */

namespace App\Packages\UnionCloud;

use Illuminate\Support\Facades\Cache;

class UnionCloud implements UnionCloudInterface
{
    public function getStudentByUID($uid)
    {
        return Cache::remember('unioncloud_package_student_'.$uid, 60, function() use ($uid){
            /** @var \Twigger\UnionCloud\API\UnionCloud $unioncloud */
            $unioncloud = app()->make(\Twigger\UnionCloud\API\UnionCloud::class);
            $student = $unioncloud->users()->getByUID($uid)->get()->first();
            return $student;
        });
    }
    public function getNameByUID($uid)
    {
        return $this->getStudentByUID($uid)->forename.' '.$this->getStudentByUID($uid)->surname;
    }

    public function getStudentIDByUid($uid)
    {
        return $this->getStudentByUID($uid)->id;
    }

}