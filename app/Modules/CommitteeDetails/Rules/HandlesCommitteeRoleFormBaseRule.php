<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 05/03/19
 * Time: 01:02
 */

namespace App\Modules\CommitteeDetails\Rules;

use App\Traits\GetsControlStudentByUnionCloudID;
use Illuminate\Contracts\Validation\Rule;
use App\Modules\CommitteeDetails\Entities\PositionSetting;
use App\Packages\ControlDB\Models\Group;
use App\Packages\ControlDB\Models\Position;
use App\Packages\ControlDB\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

abstract class HandlesCommitteeRoleFormBaseRule implements Rule
{

    use GetsControlStudentByUnionCloudID;
    /**
     * Create a new populated rule instance
     *
     * @param integer|null $ignoreCommitteeRoleID
     *
     * @throws \Exception
     */
    public function __construct($ignoreCommitteeRoleID = null)
    {
        $this->ignoredCommitteeRoleID = $ignoreCommitteeRoleID;

        $errors = $this->hydrateProperties(request());

        if (count($errors) > 0) {
            throw ValidationException::withMessages($errors);
        }
    }

    protected $ignoredCommitteeRoleID;

    /**
     * @var PositionSetting
     */
    protected $positionSetting;

    /**
     * @var Group
     */
    protected $group;

    /**
     * @var Student
     */
    protected $student;

    /**
     * @var Position
     */
    protected $position;

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    abstract public function passes($attribute, $value);

    /**
     * @return array|string
     */
    abstract public function message();


    /**
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function hydrateProperties(Request $request)
    {
        // Get the group
        $this->group = Group::find(
            getGroupID()
        );

        $this->position = Position::find($request->get('position_id'));

        try {
            $this->student = $this->getOrCreateStudentByUid($request->get('unioncloud_id'));
        } catch (\Exception $e) {
            $this->student = null;
        }

        $this->positionSetting = PositionSetting::where('tag_reference', getGroupType())->first();

        return $this->getPropertyErrors();
    }

    /**
     * Get the errors for the properties
     *
     * @return array
     */
    private function getPropertyErrors()
    {
        $errors = [];

        if ($this->group === null) { $errors['unioncloud_id'] = 'Your group could not be found.'; }

        if ($this->position === null) { $errors['position_id'] = 'The position could not be found.'; }

        if ($this->student === null) { $errors['unioncloud_id'] = 'The student could not be found.'; }

        if ($this->positionSetting === null) { $errors['position_id'] = 'The position settings could not be found.'; }

        return $errors;

    }

    protected function checkInPositionSettings($positionId, $settings)
    {
        return in_array(
            $positionId,
            $settings
        );
    }
}