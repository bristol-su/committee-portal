<?php


namespace App\Support\Activity\Contracts;


interface Repository
{
    public function active();

    public function getForParticipant();

    public function getForAdministrator();

    public function all();

    public function create(array $attributes);
}
