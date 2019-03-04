<?php

namespace App;

use App\Notifications\VerifyEmailNotification;
use App\Notifications\ResetPasswordNotification;
use App\Packages\ControlDB\ControlDBInterface;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'forename', 'surname', 'email', 'student_id', 'control_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the control database ID
     *
     * @return int
     */
    public function getControlID()
    {
        return $this->control_id;
    }

    public function isNewCommittee()
    {
        // TODO Populate is new committee Method
        return true;
    }

    public function isAdmin()
    {
        return $this->hasPermissionTo('act-as-admin');
    }

    public function getAuthenticatedUser()
    {
        if($this->isAdmin()) {
            return Auth::guard('view-as-student')->user();
        } elseif(Auth::guard('committee-role')->check() ) {
            return Auth::guard('committee-role')->user();
        }
        abort(403, 'Could not authenticate you.');
    }

    public function sendPasswordResetNotification($token)
    {
        if($this->password === null)
        {
            $this->notify(new VerifyEmailNotification($token));
        } else {

            $this->notify(new ResetPasswordNotification($token));
        }
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }

}
