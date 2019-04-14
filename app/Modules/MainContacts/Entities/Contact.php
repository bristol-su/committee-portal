<?php

namespace App\Modules\MainContacts\Entities;

use ActiveResource\ConnectionManager;
use App\Packages\ControlDB\Models\Group;
use App\Packages\ControlDB\Models\Student;
use App\Packages\ControlDB\Models\StudentTag;
use App\Traits\CanTagStudents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class Contact extends Model
{
    use SoftDeletes, CanTagStudents;

    protected $fillable = [];

    protected $table = 'maincontacts_subjects';

    /**
     * @param Student $student
     * @param Group $group
     * @throws \Exception
     */
    public function updateInControl(Student $student, Group $group)
    {

        // Get the tag to tag a student with
        $studentTag = $this->tag();

        // Get all students with this tag in this group
        $studentsWithTag = $this->students($group, $student);

        // Remove all other students from the tag
        $studentsWithTag->each(function(Student $student) use ($studentTag, $group) {

            $this->untagStudent($student, $studentTag, [
                'group_id' => $group->id
            ]);
        });

        // Tag the student with the tag if they don't already have it
        if(!$this->isStudentTagged($student, $studentTag, [
            'group_id' => $group->id
        ])) {
            $this->tagStudent($student, $studentTag, [
                'group_id' => $group->id
            ]);
            Event::dispatch('maincontacts.userAssigned', [$student, $group, $studentTag]);
        }
    }

    /**
     * @param Group $group
     *
     * @return int Control ID of the student who owns this tag
     */
    public function answer(Group $group)
    {
        $studentTag = $this->tag();
        $student = $this->getTaggedStudents($studentTag, ['group_id'=>$group->id])->first();
        return ($student===null?null:$student->id);
    }

    /**
     * Gets the tag represented by this contact situation
     *
     * @return mixed
     * @throws \Exception
     */
    public function tag()
    {
        $studentTag = StudentTag::all()->filter(function (StudentTag $studentTag) {
            return
                $studentTag->reference === $this->tag_reference &&
                $studentTag->category->reference === 'notifications_contact';
        });

        if ($studentTag === false) {
            throw new \Exception('Could not find a tag: notifications_contact.' . $this->tagReference, 500);
        }

        return $studentTag->first();
    }

    /**
     * Returns students who have this tag
     *
     * @param Group|null $group Filter the students to those acting for this group
     * @param Student|null $excludeStudent Exclude this student from the results.
     *      tags and reassign
     *
     * @return Collection
     * @throws \Exception
     */
    public function students($group=null, $excludeStudent=null)
    {
        $students = Student::allThrough($this->tag());

        if($students === false) {
            return new Collection();
        }
        return $students->filter(function($student) use ($group, $excludeStudent) {
            return
                ($group === null ? true : json_decode($student->pivot->data, true)['group_id'] === $group->id) &&
                ($excludeStudent === null ? true : $excludeStudent->id !== $student->id);
        });
    }
}
