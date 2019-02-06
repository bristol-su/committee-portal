<?php

namespace App\Packages\ControlDB;

interface ControlDBInterface
{
    public function getPositionsFromStudent(int $studentId);

    public function getGroupByID($id);

    public function getPositions();

    public function getSpecificPosition($position_id);

    public function getAllGroups();
}