<?php

namespace App\Rules;

use App\Support\Module\Contracts\ModuleRepository;
use Illuminate\Contracts\Validation\Rule;

class CompletionEvent implements Rule
{
    /**
     * @var ModuleRepository
     */
    private $moduleRepository;
    /**
     * @var null
     */
    private $alias;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($alias = null)
    {
        //
        $this->moduleRepository = resolve(ModuleRepository::class);
        $this->alias = $alias;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->alias === null) {
            $modules = $this->moduleRepository->all();
            foreach ($modules as $module) {
                foreach (config($module->alias() . '.completion') as $completionEvent) {
                    if ($value === $completionEvent['event']) {
                        return true;
                    }
                }
            }
        } else {
            $module = $this->moduleRepository->findByAlias($this->alias);
            if ($module !== null) {
                foreach (config($module->alias() . '.completion') as $completionEvent) {
                    if ($value === $completionEvent['event']) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
