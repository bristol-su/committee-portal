<?php


namespace App\Support\DataPlatform\Contracts\Models;


interface User
{

    public function id();

    public function forename();

    public function surname();

    public function email();

    public function studentId();
}
