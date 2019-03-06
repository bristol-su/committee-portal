<?php

namespace App\Modules\CommitteeDetails\Rules;

use App\Packages\ControlDB\Models\CommitteeRole;

class IsStudentAvailable extends HandlesCommitteeRoleFormBaseRule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->isStudentAvailable();
    }

    /**
     * @return bool
     */
    private function isStudentAvailable()
    {
        // Get the group committee roles involving the current student
        $currentStudentId = $this->student->id;
        $committeeRoles = CommitteeRole::allThrough($this->group)
            ->filter(function ($committeeRole) use ($currentStudentId) {
                return $committeeRole->student_id === $currentStudentId
                    && $committeeRole->committee_year === config('portal.reaffiliation_year')
                    && $this->checkInPositionSettings($committeeRole->position_id, $this->positionSetting->committee_member_only_has_single_position)
                    && $committeeRole->id !== $this->ignoredCommitteeRoleID;
            });

        return $committeeRoles->count() === 0;
    }

    /**
     * Get the validation error message.
     *
     * @return array
     */
    public function message()
    {
        return ['unioncloud_id' => 'The student is already in a position.'];
    }
}
