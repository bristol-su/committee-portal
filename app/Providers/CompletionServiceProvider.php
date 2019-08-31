<?php


namespace App\Providers;


use App\Support\Completion\CompletionTester;
use App\Support\Completion\ConfigCompletionEventRepository;
use App\Support\Completion\Contracts\CompletionEventRepository as CompletionEventRepositoryContract;
use App\Support\Completion\Contracts\CompletionTester as CompletionTesterContract;
use Illuminate\Support\ServiceProvider;

class CompletionServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(CompletionEventRepositoryContract::class, ConfigCompletionEventRepository::class);
        $this->app->bind(CompletionTesterContract::class, CompletionTester::class);
    }

    public function boot()
    {

    }


}
