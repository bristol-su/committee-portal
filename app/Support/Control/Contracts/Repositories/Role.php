<?php


namespace App\Support\Control\Contracts\Repositories;


use Illuminate\Support\Collection;

interface Role
{

    public function getById($id);

    public function allFromStudentControlID($id): Collection;

}
