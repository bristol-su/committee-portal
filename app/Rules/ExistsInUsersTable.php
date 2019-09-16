<?php

namespace App\Rules;

use BristolSU\Support\User\Contracts\UserRepository;
use Illuminate\Contracts\Validation\Rule;

class ExistsInUsersTable implements Rule
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Create a new rule instance.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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
        return $this->userRepository->getWhereIdentity($value) !== null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No user with that Email or Student ID found.';
    }
}
