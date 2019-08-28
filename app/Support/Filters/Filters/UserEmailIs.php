<?php


namespace App\Support\Filters\Filters;


use App\Support\Filters\Contracts\Filters\UserFilter;

class UserEmailIs extends UserFilter
{

    /**
     * Get possible options as an array
     *
     * @return array
     */
    public function options(): array
    {
        return [
            'email' => ''
        ];
    }

    /**
     * Test if the filter passes
     *
     * @param Object $model Group, Role or User
     * @param string $settings Key of the chosen option
     *
     * @return bool
     */
    public function evaluate($settings): bool
    {
        return $this->model()->email === $settings['email'];
    }

    public function name()
    {
        return 'User has Email';
    }

    public function description()
    {
        return 'User has a given email address';
    }

    public function alias()
    {
        return 'user_email';
    }
}
