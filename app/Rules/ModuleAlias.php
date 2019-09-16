<?php

namespace App\Rules;

use BristolSU\Support\Module\Contracts\ModuleRepository;
use Illuminate\Contracts\Validation\Rule;

class ModuleAlias implements Rule
{
    /**
     * @var ModuleRepository
     */
    private $moduleRepository;

    /**
     * Create a new rule instance.
     *
     * @param ModuleRepository $moduleRepository
     */
    public function __construct(ModuleRepository $moduleRepository)
    {
        //
        $this->moduleRepository = $moduleRepository;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->moduleRepository->findByAlias($value) !== null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The module could not be found';
    }
}
