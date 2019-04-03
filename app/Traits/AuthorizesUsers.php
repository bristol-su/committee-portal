<?php


namespace App\Traits;


use App\Packages\ControlDB\Models\Group;
use App\Packages\ControlDB\Models\GroupTag;
use App\Packages\ControlDB\Models\Position;
use App\Packages\ControlDB\Models\StudentTag;
use App\User;

trait AuthorizesUsers
{

    /**
     * Check if a group has a tag
     *
     * @param User $user
     * @param string $category
     * @param string $tag
     *
     * @return boolean
     */
    public function groupHasTag($user, $category, $tag)
    {
        return $this->getTagFromGroup($this->group($user), $category, $tag) !== null;
    }

    /**
     * Check if a student has a tag
     *
     * @param User $user
     * @param string $category
     * @param string $tag
     * @param array|null $data Data to apply when searching for a tag
     *
     * @return boolean
     */
    public function studentHasTag($user, $category, $tag, $data = null)
    {
        return $this->getTagFromStudent($this->group($user), $category, $tag, $data) !== null;
    }

    /**
     * Check if a student has a presidential position
     *
     * @param User $user
     *
     * @return boolean
     */
    public function studentHasPresidentialPosition($user)
    {
        return in_array($this->position($user)->id, config('portal.position_grouping.presidents'));
    }

    /**
     * Check if a student has a treasurer position
     *
     * @param User $user
     *
     * @return boolean
     */
    public function studentHasTreasurerPosition($user)
    {
        return in_array($this->position($user)->id, config('portal.position_grouping.treasurers'));
    }

    public function studentIsNewCommittee(User $user)
    {
        return $user->getCurrentRole()->committee_year === getReaffiliationYear();
    }

    public function studentIsOldCommittee(User $user)
    {
        return !$this->studentIsNewCommittee($user);
    }

    /**
     * Get a tag from a group
     *
     * @param Group $group
     * @param string $categoryReference
     * @param string $tagReference
     *
     * @return GroupTag|null
     */
    public function getTagFromGroup($group, $categoryReference, $tagReference)
    {
        $groupTags = GroupTag::allThrough($group);
        $groupTags = $groupTags->filter(function ($groupTag) use ($categoryReference, $tagReference) {
            return $groupTag->reference === $tagReference && $groupTag->category->reference === $categoryReference;
        });

        return $groupTags->first();
    }

    /**
     * Get a tag from a student
     *
     * @param Group $group
     * @param string $categoryReference
     * @param string $tagReference
     *
     * @return GroupTag|null
     */
    public function getTagFromStudent($user, $categoryReference, $tagReference, $data)
    {
        $studentTags = StudentTag::allThrough($user);
        $studentTags = $studentTags->filter(function ($studentTag) use ($categoryReference, $tagReference, $data) {
            return $studentTag->reference === $tagReference &&
                $studentTag->category->reference === $categoryReference &&
                $studentTag->pivot->data === $data;
        });
        return $studentTags->first();
    }

    /**
     * Get a group from a user
     *
     * @param User $user
     *
     * @return Group
     */
    private function group($user)
    {
        return $user->getCurrentRole()->group;
    }

    /**
     * Get a position from a user
     *
     * @param User $user
     *
     * @return Position
     */
    private function position($user)
    {
        return $user->getCurrentRole()->position;
    }

}