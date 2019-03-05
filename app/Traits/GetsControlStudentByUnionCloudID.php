<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 04/03/19
 * Time: 23:52
 */

namespace App\Traits;

// TODO Remove the need for this when reformatting control package

// TODO Needs to be implemented throughout site

use ActiveResource\ConnectionManager;
use App\Packages\ControlDB\Models\Student;

trait GetsControlStudentByUnionCloudID
{

    /**
     * @param $uid
     * @return Student
     * @throws \Exception
     */
    public function getStudentByUid($uid)
    {

        $student = new Student();

        // Send request
        $connection = ConnectionManager::get('control');
        $request = $connection->buildRequest('post', 'students/search', ['uc_uid' => $uid]);
        $response = $connection->send($request);

        // Parse the response by hydrating the model
        if ($response->isSuccessful()) {
            $student->hydrate($response->getPayload()[0]);
            return $student;
        } else {
            throw new \Exception('Student not found', 404);
        }
    }

}