<?php

namespace App\Http;

use App\Http\Middleware\AuthenticateUserGuard;
use App\Http\Middleware\CheckAdminCanViewAsStudent;
use App\Http\Middleware\CheckIfAdmin;
use App\Http\Middleware\CheckPasswordIsSet;
use App\Http\Middleware\LoadGroupTagsFromControl;
use App\Http\Middleware\LoadStudentTagsFromControl;
use App\Http\Middleware\SetAdminGuard;
use App\Modules\BaseModule\Http\Middleware\CheckDevelopmentStatus;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'committee-role' => AuthenticateUserGuard::class,
        'is-admin' => CheckIfAdmin::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'module.status' => CheckDevelopmentStatus::class,
        'can-view-as-student' => CheckAdminCanViewAsStudent::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],

        'user' => [
            'auth:web',
            'committee-role',
            'verified',
            LoadGroupTagsFromControl::class,
            LoadStudentTagsFromControl::class
        ],

        'admin' => [
            'auth:web',
            'is-admin',
            'verified',
        ],

        'module' => [

        ]
    ];

    /**
     * The priority-sorted list of middleware.
     *
     * This forces non-global middleware to always be in the given order.
     *
     * @var array
     */
    protected $middlewarePriority = [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\Authenticate::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        EnsureEmailIsVerified::class,
        CheckIfAdmin::class,
        AuthenticateUserGuard::class,
        LoadStudentTagsFromControl::class,
        LoadGroupTagsFromControl::class,
        \Illuminate\Auth\Middleware\Authorize::class,
        CheckDevelopmentStatus::class
    ];
}
