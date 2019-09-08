<?php

namespace App;

use App\Mail\ResetPasswordMail;
use App\Mail\VerifyEmailMail;
use App\Packages\ControlDB\Models\CommitteeRole;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

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
     * @return CommitteeRole
     */
    public function getCurrentRole()
    {
        return Auth::guard('role')->user();
    }

    // TODO isAdmin method calls should be replaced with a call to check the permission of act-as-admin. Make sure to use can() or hasPermissionTo() in the right places.
    public function isAdmin()
    {
        return $this->hasPermissionTo('act-as-admin') || $this->hasPermissionTo('act-as-super-admin');
    }

    public function sendPasswordResetNotification($token)
    {
        Mail::to($this->email)->send(new ResetPasswordMail($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        Mail::to($this->email)->send(new VerifyEmailMail($this));
    }
}
