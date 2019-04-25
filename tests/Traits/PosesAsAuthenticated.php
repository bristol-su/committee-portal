<?php


namespace Tests\Traits;


use App\Authentication\ViewAsStudent;
use App\Packages\ControlDB\Models\CommitteeRole;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

trait PosesAsAuthenticated
{

    /**
     * Holds the currently authenticated user
     *
     * @var User
     */
    protected $user;

    /**
     * Holds the role of the currently authenticated user
     *
     * @var CommitteeRole|ViewAsStudent
     */
    protected $role;

    /**
     * Logs the user in as a student
     *
     * @return $this
     */
    public function beStudent()
    {
        $this->user = factory(User::class)->create();
        $this->be($this->user);
        return $this;
    }

    /**
     * Gives the current user a committee role
     *
     * @return $this
     */
    public function withRole()
    {
        $role = CommitteeRole::find(558);
        $this->be($role, 'committee-role');
        $this->role = $role;
        return $this;
    }

    /**
     * Logs the user in as a super administrator
     *
     * @return $this
     */
    public function beSuperAdmin()
    {
        $this->user = factory(User::class)->create()->givePermissionTo('act-as-super-admin');
        $this->be($this->user);
        return $this;
    }

    /**
     * Gives the current user a View as Student login
     *
     * @return $this
     */
    public function viewingAsStudent()
    {
        $this->role = new ViewAsStudent(1);
        $this->be($this->role, 'view-as-student');
        return $this;
    }

    /**
     * Logs the user in as an administrator
     *
     * @return $this
     */
    public function beAdmin()
    {
        $this->user = factory(User::class)->create()->givePermissionTo('act-as-admin');
        $this->be($this->user);
        return $this;
    }

    /**
     * Logs out of a users role
     *
     * @return $this
     */
    public function logoutRole()
    {
        if(Auth::guard('committee-role')->check()) {
            Auth::guard('committee-role')->logout();
        }

        if(Auth::guard('view-as-student')->check()) {
            Auth::guard('view-as-student')->logout();
        }

        $this->role = null;

        return $this;
    }

    /**
     * Logs out a user identity
     *
     * @return $this
     */
    public function logout()
    {
        $this->logoutRole();
        Auth::logout();
        $this->user = null;

        return $this;
    }

    /**
     * Get the currently logged in user
     *
     * @return User
     */
    public function identity()
    {
        return $this->user;
    }

    /**
     * Get the currently logged in users roles.
     *
     * @return ViewAsStudent|CommitteeRole
     */
    public function role()
    {
        return $this->role;
    }

    /**
     * @param string|array $permissions
     *
     * @return $this
     */
    public function allowedTo($permissions)
    {
        $this->user->givePermissionTo($permissions);
        return $this;
    }

}