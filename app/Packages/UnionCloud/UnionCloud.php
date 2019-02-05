<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 03/02/19
 * Time: 19:23
 */

namespace App\Packages\UnionCloud;

use Illuminate\Support\Facades\Cache;
use Twigger\UnionCloud\API\Exception\BaseUnionCloudException;

class UnionCloud implements UnionCloudInterface
{

    protected $unioncloud;

    public function __construct(\Twigger\UnionCloud\API\UnionCloud $unioncloud )
    {
        $this->unioncloud = $unioncloud;
    }

    public function getStudentByUID($uid)
    {
        return Cache::remember('unioncloud_package_student_'.$uid, 60, function() use ($uid){
            /** @var \Twigger\UnionCloud\API\UnionCloud $unioncloud */
            $student = $this->unioncloud->users()->getByUID($uid)->get()->first();
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

    public function getAccountSearchDetails($q)
    {
        // Grab from the cache if possible!

        return Cache::remember('unioncloud_package_search_for_account.' . htmlspecialchars($q), 60, function () use ($q){

            try {
                $users = $this->unioncloud->users()->search(['id' => $q])->get()->toArray();
            } catch (BaseUnionCloudException $e) {
                $users = $this->unioncloud->users()->search(['email' => $q])->get()->toArray();
            }


            $reducedUser = [];

            foreach ($users as $user) {
                $reducedUser[] = [
                    'uid' => $user->uid,
                    'name' => $user->forename . ' ' . $user->surname,
                    'email' => $user->email
                ];
            }

            return $reducedUser;

        });
    }
}