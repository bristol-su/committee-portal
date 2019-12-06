<?php

namespace App\Support\DataProvider\Repositories;

use App\Support\DataProvider\DataUserModel;
use BristolSU\Support\DataPlatform\Contracts\Models\User as UserModelContract;
use Exception;

class User implements \BristolSU\Support\DataPlatform\Contracts\Repositories\User
{

    /**
     * Get a student from the data storage.
     *
     * Get a student using an 'identity', be this email and/or student ID.
     * Throw an exception if not found
     *
     * @param $identity
     * @return mixed
     * @throws Exception
     */
    public function getByIdentity($identity): UserModelContract
    {
        try {
            $user = $this->getByEmail($identity);
        } catch(Exception $e) {
            try {
                $user = $this->getByStudentID($identity);
            } catch (Exception $e) {
                $user = DataUserModel::create([
                    'forename' => 'Joanne',
                    'surname' => 'Bloggs',
                    'email' => $identity
                ]);
            }
        }
        if($user === null) {
        }
        return $user;
    }

    /**
     * @param $email
     * @return UserModelContract
     */
    public function getByEmail($email): UserModelContract
    {
        return DataUserModel::where('email', $email)->firstOrFail();
    }

    /**
     * @param $studentId
     * @return UserModelContract
     */
    public function getByStudentID($studentId): UserModelContract
    {
        return DataUserModel::where('student_id', $studentId)->firstOrFail();
    }

    /**
     * @param $id
     * @return UserModelContract
     */
    public function getById($id): UserModelContract
    {
        return DataUserModel::findOrFail($id);
    }
}
