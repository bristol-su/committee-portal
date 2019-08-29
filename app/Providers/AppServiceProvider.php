<?php

namespace App\Providers;

use App\Packages\UnionCloud\UnionCloud;
use App\Packages\UnionCloud\UnionCloudInterface;
use App\Support\Activity\Contracts\Repository as ActivityRepositoryContract;
use App\Support\Activity\Repository as ActivityRepository;
use App\Support\Logic\Contracts\LogicTester as LogicTesterContract;
use App\Support\Logic\LogicTester;
use App\Support\Module\Contracts\ModuleRepository as ModuleRepositoryContract;
use App\Support\Module\ModuleRepository;
use App\Support\ModuleInstance\Contracts\Evaluator\ActivityEvaluator as ActivityEvaluatorContract;
use App\Support\ModuleInstance\Contracts\Evaluator\Evaluation as EvaluationContract;
use App\Support\ModuleInstance\Contracts\Evaluator\ModuleInstanceEvaluator as ModuleInstanceEvaluatorContract;
use App\Support\ModuleInstance\Contracts\ModuleInstanceRepository as ModuleInstanceRepositoryContract;
use App\Support\ModuleInstance\Evaluator\ActivityEvaluator;
use App\Support\ModuleInstance\Evaluator\Evaluation;
use App\Support\ModuleInstance\Evaluator\ModuleInstanceEvaluator;
use App\Support\ModuleInstance\ModuleInstanceRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Passport::withoutCookieSerialization();

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UnionCloudInterface::class, UnionCloud::class);
        $this->app->bind(ModuleRepositoryContract::class, ModuleRepository::class);
        $this->app->bind(ModuleInstanceRepositoryContract::class, ModuleInstanceRepository::class);

        // Logic
        $this->app->bind(LogicTesterContract::class, LogicTester::class);


        // Activities
        $this->app->bind(ActivityRepositoryContract::class, ActivityRepository::class);

        // Module Instances
        $this->app->bind(ActivityEvaluatorContract::class, ActivityEvaluator::class);
        $this->app->bind(ModuleInstanceEvaluatorContract::class, ModuleInstanceEvaluator::class);
        $this->app->bind(EvaluationContract::class, Evaluation::class);
    }
}
