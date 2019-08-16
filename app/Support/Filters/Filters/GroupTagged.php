<?php


namespace App\Support\Filters\Filters;


use App\Support\Authentication\Contracts\Authentication;
use App\Support\Control\Repositories\Contracts\GroupTag as GroupTagRepositoryContract;
use App\Support\Filters\Contracts\Filters\GroupFilter;

class GroupTagged extends GroupFilter
{

    /**
     * @var GroupTagRepositoryContract
     */
    private $groupTagRepository;

    public function __construct(Authentication $authentication, GroupTagRepositoryContract $groupTagRepository)
    {
        parent::__construct($authentication);
        $this->groupTagRepository = $groupTagRepository;
    }

    public function evaluate($settings): bool
    {
        $tags = $this->groupTagRepository->allThroughGroup($this->model());
        foreach($tags as $tag) {
            if($tag->fullReference() === $settings['tag']) {
                return true;
            }
        }
        return false;
    }

    public function options(): array
    {
        $tags = $this->groupTagRepository->all();
        $options = ['tag' => []];
        foreach($tags as $tag) {
            $options['tag'][$tag->fullReference()] = $tag->name();
        }
        return $options;
    }

}
