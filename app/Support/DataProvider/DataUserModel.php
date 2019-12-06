<?php

namespace App\Support\DataProvider;

use BristolSU\Support\User\User;

class DataUserModel extends User implements \BristolSU\Support\DataPlatform\Contracts\Models\User
{
    protected $table = 'data_users';

    public function id()
    {
        return $this->id;
    }

    public function forename()
    {
        return 'Forename';
    }

    public function surname()
    {
        return 'Surname';
    }

    public function email()
    {
        return $this->email;
    }

    public function studentId()
    {
        return $this->student_id;
    }
}
