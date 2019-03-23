<?php

namespace App\Modules\GroupInfo\Providers;

use App\Modules\GroupInfo\Questions\Question\Affiliations;
use App\Modules\GroupInfo\Questions\Question\AssociateMembers;
use App\Modules\GroupInfo\Questions\Question\BookExternalCoaches;
use App\Modules\GroupInfo\Questions\Question\Email;
use App\Modules\GroupInfo\Questions\Question\ExternalAccount;
use App\Modules\GroupInfo\Questions\Question\GroupType;
use App\Modules\GroupInfo\Questions\Question\IntramuralInterest;
use App\Modules\GroupInfo\Questions\Question\VolunteeringActivity;
use App\Modules\GroupInfo\Questions\QuestionService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class QuestionServiceProvider extends ServiceProvider
{

    protected $questions = [
        GroupType::class,
        Email::class,
        ExternalAccount::class,
        Affiliations::class,
        BookExternalCoaches::class,
        IntramuralInterest::class,
        AssociateMembers::class,
        VolunteeringActivity::class
    ];

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(QuestionService::class, function($app) {
            return new QuestionService($this->questions);
        });
    }

    public function boot()
    {
        View::composer('groupinfo::base_group_form', function ($view) {
            $questionService = resolve(QuestionService::class);
            return $view->with('questions', $questionService->getQuestions());
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
