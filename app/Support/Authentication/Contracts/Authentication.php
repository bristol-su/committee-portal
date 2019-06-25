<?php

namespace App\Support\Authentication\Contracts;

interface Authentication
{
    public function getGroup();

    public function getRole();

    public function getUser();

}