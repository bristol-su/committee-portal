<?php

namespace App\Http;

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\AuthenticateUserGuard;
use App\Http\Middleware\CheckAdminCanViewAsStudent;
use App\Http\Middleware\CheckForMaintenanceMode;
use App\Http\Middleware\CheckIfAdmin;
use App\Http\Middleware\CheckModuleActive;
use App\Http\Middleware\CheckModuleDevelopmentStatus;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\LoadGroupTagsFromControl;
use App\Http\Middleware\LoadStudentTagsFromControl;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\TrimStrings;
use App\Http\Middleware\TrustProxies;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

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
        CheckForMaintenanceMode::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
        TrustProxies::class,

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
        'auth' => Authenticate::class,
        'committee-role' => AuthenticateUserGuard::class,
        'is-admin' => CheckIfAdmin::class,
        'auth.basic' => AuthenticateWithBasicAuth::class,
        'bindings' => SubstituteBindings::class,
        'cache.headers' => SetCacheHeaders::class,
        'can' => Authorize::class,
        'guest' => RedirectIfAuthenticated::class,
        'signed' => ValidateSignature::class,
        'throttle' => ThrottleRequests::class,
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
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
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
        /*
         * Request Middleware
         */

        // Start the current session
        StartSession::class,

        // Share errors from the session
        ShareErrorsFromSession::class,

        // Load authentication information from the session (?)
        AuthenticateSession::class,

        // Allow for route model binding
        SubstituteBindings::class,

        // Validate the request signature (?)
        ValidateSignature::class,

        // Verify the CSRF token
        VerifyCsrfToken::class,

        // Throttle requests
        ThrottleRequests::class,

        // Check the user is logged in
        Authenticate::class,

        // Check the user is logged in (not used)
        AuthenticateWithBasicAuth::class,

        // Redirect a logged out user to the login page when authenticated
        RedirectIfAuthenticated::class,

        // Check a users email is verified
        EnsureEmailIsVerified::class,

        // Log into a committee role
        AuthenticateUserGuard::class,

        // Check if the current user is an admin
        CheckIfAdmin::class,

        // Authorization middleware for use with can:
        Authorize::class,

        // Check a module is active when being accessed
        CheckModuleActive::class,

        // Load all student tags for the current user from control
        LoadStudentTagsFromControl::class,

        // Load all group tags for the current users group from control
        LoadGroupTagsFromControl::class,

        // Show maintenance page if a module is down for maintenance
        CheckModuleDevelopmentStatus::class,


        /*
         * Response Middleware
         */

        // Set cache headers on the response
        SetCacheHeaders::class,

        // Add cookies to response
        AddQueuedCookiesToResponse::class,

        // Encrypt cookies on response
        EncryptCookies::class,
    ];
}
