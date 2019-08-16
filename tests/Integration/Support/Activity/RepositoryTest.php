<?php


namespace Tests\Integration\Support\Activity;


use App\Support\Activity\Activity;
use App\Support\Activity\Repository as ActivityRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Tests\TestCase;

class RepositoryTest extends TestCase
{

    /** @test */
    public function it_returns_all_active_activities(){
        $activeActivities = factory(Activity::class, 2)->create([
            'start_date' => null, 'end_date' => null
        ]);
        $activeActivities->push(factory(Activity::class)->create([
            'start_date' => Carbon::now()->subDay(),
            'end_date' => Carbon::now()->addDay()
        ]));
        $inactiveActivities = factory(Activity::class, 2)->create([
            'start_date' => Carbon::now()->addDay(),
            'end_date' => Carbon::now()->addWeek()
        ]);

        $activities = (new ActivityRepository)->active();

        $activeActivities->each(function($activity) use (&$activities){
            $this->assertModelEquals($activity, $activities->shift());
        });
        $this->assertEmpty($activities);
    }

    /** @test */
    public function it_returns_all_activities_relevant_to_a_participant(){
        $participantActivity = factory(Activity::class)->create();
        $adminActivity = factory(Activity::class)->create();
        $neitherActivity = factory(Activity::class)->create();

        $this->createLogicTester($participantActivity->forLogic, [$adminActivity->forLogic, $neitherActivity->forLogic]);

        $activitiesForUser = (new ActivityRepository)->getForParticipant();
        $this->assertCount(1, $activitiesForUser);
        $this->assertModelEquals($participantActivity, $activitiesForUser->first());
    }

    /** @test */
    public function it_returns_all_activities_relevant_to_an_administrator(){
        $participantActivity = factory(Activity::class)->create();
        $adminActivity = factory(Activity::class)->create();
        $neitherActivity = factory(Activity::class)->create();

        $this->createLogicTester($adminActivity->adminLogic, [$participantActivity->adminLogic, $neitherActivity->adminLogic]);

        $activitiesForAdmin = (new ActivityRepository)->getForAdministrator();
        $this->assertCount(1, $activitiesForAdmin);
        $this->assertModelEquals($adminActivity, $activitiesForAdmin->first());
    }

    /** @test */
    public function it_returns_an_empty_collection_if_no_participant_activities_are_found(){
        $adminActivity = factory(Activity::class)->create();
        $neitherActivity = factory(Activity::class)->create();

        $this->createLogicTester([], [$adminActivity->forLogic, $neitherActivity->forLogic]);

        $activitiesForUser = (new ActivityRepository)->getForParticipant();
        $this->assertInstanceOf(Collection::class, $activitiesForUser);
        $this->assertEmpty($activitiesForUser);
    }

    /** @test */
    public function it_returns_an_empty_collection_if_no_administrator_activities_are_found(){
        $participantActivity = factory(Activity::class)->create();
        $neitherActivity = factory(Activity::class)->create();

        $this->createLogicTester([], [$participantActivity->adminLogic, $neitherActivity->adminLogic]);

        $activitiesForAdmin = (new ActivityRepository)->getForAdministrator();
        $this->assertInstanceOf(Collection::class, $activitiesForAdmin);
        $this->assertEmpty($activitiesForAdmin);
    }

}
