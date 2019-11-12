<?php

namespace App\Exceptions;

use BristolSU\Support\Authorization\Exception\ActivityRequiresAdmin;
use BristolSU\Support\Authorization\Exception\ActivityRequiresGroup;
use BristolSU\Support\Authorization\Exception\ActivityRequiresRole;
use BristolSU\Support\Authorization\Exception\ActivityRequiresUser;
use BristolSU\Support\Authorization\Exception\ModuleInactive;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Exception $exception
     * @return Response
     */
    public function render($request, Exception $exception)
    {
        if (!$request->expectsJson()) {

            if ($exception instanceof ActivityRequiresUser) {
                return redirect()->route('login.user', [
                    'activity_slug' => $exception->getActivity()->slug,
                    'redirect' => $request->fullUrl()
                ]);
            }
            if ($exception instanceof ActivityRequiresGroup) {
                return redirect()->route('login.group', [
                    'activity_slug' => $exception->getActivity()->slug,
                    'redirect' => $request->fullUrl()
                ]);
            }
            if ($exception instanceof ActivityRequiresRole) {
                return redirect()->route('login.role', [
                    'activity_slug' => $exception->getActivity()->slug,
                    'redirect' => $request->fullUrl()
                ]);
            }
            if($exception instanceof ActivityRequiresAdmin) {
                return redirect()->route('login.admin', [
                    'activity_slug' => $exception->getActivity()->slug,
                    'redirect' => $request->fullUrl()
                ]);
            }
            if($exception instanceof ModuleInactive) {
                dd($exception);
            }
        }

        // TODO Handle exceptions above if expects json

        return parent::render($request, $exception);
    }
}
