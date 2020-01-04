<?php

namespace App\Http\View\Header;

use BristolSU\Support\Authentication\Contracts\Authentication;
use BristolSU\ControlDB\Contracts\Models\Role;
use Illuminate\Contracts\View\View;

class CurrentAuthComposer
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
        $view->with('currentUser', $this->authentication->getUser());
        $view->with('currentGroup', $this->authentication->getGroup());
        $view->with('currentRole', $this->authentication->getRole());
    }
}
