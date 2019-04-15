<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 24/03/19
 * Time: 20:18
 */

namespace App\Traits;


use App\Jobs\AddTagToStudent;
use App\Jobs\RemoveTagFromStudent;
use App\Packages\ControlDB\Models\Student;
use App\Packages\ControlDB\Models\StudentTag;

trait CanTagStudents
{
    public function tagStudent($student, $tag, $data)
    {
        AddTagToStudent::dispatch($student, $tag, $data);
    }

    public function untagStudent($student, $tag, $data)
    {
        RemoveTagFromStudent::dispatch($student, $tag, $data);
    }

    public function isStudentTagged(Student $student, StudentTag $tag, array $data) : bool
    {
        $studentTags = StudentTag::allThrough($student);
        return $studentTags->filter(function($studentTag) use ($tag, $data) {
            return $studentTag->id === $tag->id && $studentTag->pivot->data === json_encode($data);
        })->count() > 0;

    }

    public function getTaggedStudents(StudentTag $studentTag, array $data)
    {
        $students = Student::allThrough($studentTag);

        return $students->filter(function($student) use ($data) {
            return $student->pivot->data === json_encode($data);
        });
    }
}