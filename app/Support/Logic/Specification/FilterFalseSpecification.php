<?php


namespace App\Support\Logic\Specification;


use App\Support\Logic\Contracts\Filter as FilterContract;

class FilterFalseSpecification
{

    /**
     * @var FilterContract
     */
    private $filter;
    private $model;
    private $setting;

    public function __construct(FilterContract $filter, $model, $setting)
    {

        $this->filter = $filter;
        $this->model = $model;
        $this->setting = $setting;
    }

    public function isSatisfied()
    {
        if($this->model === null) {
            return false;
        }
        return $this->filter->evaluate($this->model, $this->setting) === false;
    }

}