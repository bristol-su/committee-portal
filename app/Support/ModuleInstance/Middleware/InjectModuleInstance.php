<?php


namespace App\Support\ModuleInstance\Middleware;


use App\Support\ModuleInstance\ModuleInstance;
use Illuminate\Contracts\Container\Container;
use Symfony\Component\HttpFoundation\Request;

class InjectModuleInstance
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
        $moduleInstance = $request->route('module_instance_slug');
        $this->app->instance(ModuleInstance::class, $moduleInstance);

        return $next($request);
    }

}
