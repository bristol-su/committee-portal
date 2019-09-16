<?php

namespace App\Http\View\Header;

use BristolSU\Support\Authentication\Contracts\Authentication;
use BristolSU\Support\Control\Contracts\Models\Role;
use Illuminate\Contracts\View\View;

class CurrentRoleComposer
{
    /**
     * @var Authentication
     */
    private $authentication;

    /**
     * CurrentRoleComposer constructor.
     * @param Authentication $authentication
     */
    public function __construct(Authentication $authentication)
    {
        $this->authentication = $authentication;
    }

    public function compose(View $view)
    {
        $view->with('currentRole', $this->authentication->getRole());
    }
}
