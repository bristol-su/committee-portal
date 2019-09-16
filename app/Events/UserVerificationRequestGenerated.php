<?php

namespace App\Events;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Events\Dispatchable;

class UserVerificationRequestGenerated extends Registered
{
    use Dispatchable;

}
