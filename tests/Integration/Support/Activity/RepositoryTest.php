<?php


namespace Tests\Integration\Support\Activity;


use App\Support\Activity\Activity;
use App\Support\Activity\Repository as ActivityRepository;
use App\Support\Logic\Logic;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Tests\TestCase;

class RepositoryTest extends TestCase
{

    /**
     * @test
     */
    public function active_returns_all_active_activities(){
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

    /**
     * @test
     */
    public function get_for_participant_returns_all_activities_relevant_to_a_participant(){
        $participantActivity = factory(Activity::class)->create();
        $adminActivity = factory(Activity::class)->create();
        $neitherActivity = factory(Activity::class)->create();

        $this->createLogicTester($participantActivity->forLogic, [$adminActivity->forLogic, $neitherActivity->forLogic]);

        $activitiesForUser = (new ActivityRepository)->getForParticipant();
        $this->assertCount(1, $activitiesForUser);
        $this->assertModelEquals($participantActivity, $activitiesForUser->first());
    }

    /**
     * @test
     */
    public function get_for_administrator_returns_all_activities_relevant_to_an_administrator(){
        $participantActivity = factory(Activity::class)->create();
        $adminActivity = factory(Activity::class)->create();
        $neitherActivity = factory(Activity::class)->create();

        $this->createLogicTester($adminActivity->adminLogic, [$participantActivity->adminLogic, $neitherActivity->adminLogic]);

        $activitiesForAdmin = (new ActivityRepository)->getForAdministrator();
        $this->assertCount(1, $activitiesForAdmin);
        $this->assertModelEquals($adminActivity, $activitiesForAdmin->first());
    }

    /**
     * @test
     */
    public function get_for_participant_returns_an_empty_collection_if_no_participant_activities_are_found(){
        $adminActivity = factory(Activity::class)->create();
        $neitherActivity = factory(Activity::class)->create();

        $this->createLogicTester([], [$adminActivity->forLogic, $neitherActivity->forLogic]);

        $activitiesForUser = (new ActivityRepository)->getForParticipant();
        $this->assertInstanceOf(Collection::class, $activitiesForUser);
        $this->assertEmpty($activitiesForUser);
    }

    /**
     * @test
     */
    public function get_for_administrator_returns_an_empty_collection_if_no_administrator_activities_are_found(){
        $participantActivity = factory(Activity::class)->create();
        $neitherActivity = factory(Activity::class)->create();

        $this->createLogicTester([], [$participantActivity->adminLogic, $neitherActivity->adminLogic]);

        $activitiesForAdmin = (new ActivityRepository)->getForAdministrator();
        $this->assertInstanceOf(Collection::class, $activitiesForAdmin);
        $this->assertEmpty($activitiesForAdmin);
    }

    /** @test */
    public function all_retrieves_all_activities(){
        $activities = factory(Activity::class, 10)->create();
        $activities->push(factory(Activity::class)->state('always_active')->create());
        $activities->push(factory(Activity::class)->state('inactive')->create());
        $repository = new ActivityRepository();
        $allActivities = $repository->all();
        foreach($activities as $activity) {
            $this->assertModelEquals($activity, $allActivities->shift());
        }
    }

    /** @test */
    public function create_creates_an_activity(){
        $attributes = [
            'name' => 'activity name',
            'description' => 'This is some activity here',
            'activity_for' => 'user',
            'for_logic' => factory(Logic::class)->create()->id,
            'admin_logic' => factory(Logic::class)->create()->id,
            'start_date' => Carbon::now()->subDay()->toDateTimeString(),
            'end_date' => Carbon::now()->addDay()->toDateTimeString(),
        ];

        $repository = new ActivityRepository;
        $repository->create($attributes);
        $this->assertDatabaseHas('activities', $attributes);
    }

}
