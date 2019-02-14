<?php

namespace App\Packages\ControlDB;

interface ControlDBInterface
{
    public function getAuthToken();

    public function getPositionsByStudentID(int $studentId);

    public function getGroupByID($id);

    public function getAllPositions();

    public function getPositionByID($position_id);

    public function getAllGroups();
}