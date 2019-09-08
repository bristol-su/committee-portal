<?php


namespace App\Support\Activity\Middleware;


use App\Support\Activity\Activity;
use Illuminate\Contracts\Container\Container;
use Illuminate\Http\Request;

class InjectActivityInstance
{

    /**
     * @var Container
     */
    private $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public function handle(Request $request, \Closure $next)
    {
        $activity = $request->route('activity_slug');
        $this->app->instance(Activity::class, $activity);

        return $next($request);
    }
}
