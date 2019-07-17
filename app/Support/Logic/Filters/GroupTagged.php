<?php

namespace App\Support\Logic\Filters;

use App\Support\Control\Models\Contracts\Group;
use App\Support\Control\Repositories\Contracts\GroupTag as GroupTagRepository;
use App\Support\Logic\Contracts\Filter;

class GroupTagged implements Filter
{

    /**
     * @var GroupTagRepository
     */
    private $groupTagRepository;

    public function __construct(GroupTagRepository $groupTagRepository)
    {

        $this->groupTagRepository = $groupTagRepository;
    }

    public static function name(): string
    {
        return 'Group Tagged';
    }

    public static function description(): string
    {
        return 'A group must have this tag';
    }

    public function validFor() : string
    {
        return 'group';
    }

    public function options(): array
    {
        $groupTags = $this->groupTagRepository->all();
        $options = [];
        foreach($groupTags as $groupTag) {
            $options[$groupTag->fullReference()] = $groupTag->name();
        }

        return $options;
    }

    /**
     * Evaluate if a group has a tag or not
     *
     * @param Group $model
     * @param string $settings Full reference of the tag
     * @return bool
     */
    public function evaluate($model, $settings) : bool
    {
        $tags = $this->groupTagRepository->allThroughGroup($model);
        foreach($tags as $tag) {
            if($tag->fullReference() === $settings) {
                return true;
            }
        }

        return false;
    }


}