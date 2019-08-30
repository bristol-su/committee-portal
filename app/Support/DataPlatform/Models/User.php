<?php


namespace App\Support\DataPlatform\Models;


use App\Support\DataPlatform\Contracts\Models\User as UserContract;

class User extends Model implements UserContract
{

    public function id()
    {
        return $this->uid;
    }

    public function forename()
    {
        return $this->forename;
    }

    public function surname()
    {
        return $this->surname;
    }

    public function email()
    {
        return $this->email;
    }

    public function studentId()
    {
        return $this->id;
    }


}
