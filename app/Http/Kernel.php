<?php

namespace App\Http;

use App\Http\Middleware\AuthenticateUserGuard;
use App\Http\Middleware\CheckAdminCanViewAsStudent;
use App\Http\Middleware\CheckIfAdmin;
use App\Http\Middleware\CheckModuleActive;
use App\Http\Middleware\CheckModuleDevelopmentStatus;
use App\Http\Middleware\LoadGroupTagsFromControl;
use App\Http\Middleware\LoadStudentTagsFromControl;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use RenatoMarinho\LaravelPageSpeed\Middleware\InLinePreviewImages;
use RenatoMarinho\LaravelPageSpeed\Middleware\MakeGoogleAnalyticsAsync;

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

        // Minify HTML
//        \RenatoMarinho\LaravelPageSpeed\Middleware\InlineCss::class,
//        \RenatoMarinho\LaravelPageSpeed\Middleware\InsertDNSPrefetch::class,
//        \RenatoMarinho\LaravelPageSpeed\Middleware\RemoveComments::class,
//        \RenatoMarinho\LaravelPageSpeed\Middleware\CollapseWhitespace::class,
//        InLinePreviewImages::class,
//        MakeGoogleAnalyticsAsync::class,
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
        'verified' => EnsureEmailIsVerified::class,
        'module.active' => CheckModuleActive::class,
        'module.maintenance' => CheckModuleDevelopmentStatus::class,
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
        CheckModuleDevelopmentStatus::class
    ];
}
