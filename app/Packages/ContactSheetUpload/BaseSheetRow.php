<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 07/02/19
 * Time: 17:04
 */

namespace App\Packages\ContactSheetUpload;


use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Group;
use App\Packages\ControlDB\Models\Position;
use App\Packages\ControlDB\Models\Student;
use Mockery\Exception;

abstract class BaseSheetRow
{

    /**
     * @var Position
     */
    protected $position;

    /**
     * @var Student
     */
    protected $student;

    /**
     * @var Group
     */
    protected $group;

    /**
     * @var CommitteeRole
     */
    protected $positionStudentGroup;

    protected $elements;

    public function __construct(Position $position, Student $student, Group $group, CommitteeRole $psg)
    {
        $this->position = $position;
        $this->student = $student;
        $this->group = $group;
        $this->positionStudentGroup = $psg;
    }

    abstract public function generateData();

    public function __toString()
    {
        return implode(',', $this->elements);
    }

    public function getElements()
    {
        return $this->elements;
    }

    public function __get($key) {
        try {

            if(array_key_exists($key, $this->elements))
            {
                return $this->elements[$key];
            }
            return;
        } catch (\Exception $e) {
        }
    }

    abstract public static function getHeaders();


}