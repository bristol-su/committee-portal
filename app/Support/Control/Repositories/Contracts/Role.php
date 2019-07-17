<?php


namespace App\Support\Control\Repositories\Contracts;


use Illuminate\Support\Collection;

interface Role
{

    public function getById($id);

    public function allFromStudentControlID($id): Collection;

}