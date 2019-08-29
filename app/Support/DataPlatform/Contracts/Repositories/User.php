<?php


namespace App\Support\DataPlatform\Contracts\Repositories;


use App\Support\DataPlatform\Contracts\Models\User as UserModelContract;

interface User
{

    /**
     * Get a student from the data storage.
     *
     * Get a student using an 'identity', be this email and/or student ID.
     * Throw an exception if not found
     *
     * @param $identity
     * @throws \Exception
     * @return mixed
     */
    public function getByIdentity($identity) : UserModelContract;

    public function getByEmail($email) : UserModelContract;

    public function getByStudentID($studentId) : UserModelContract;
}
