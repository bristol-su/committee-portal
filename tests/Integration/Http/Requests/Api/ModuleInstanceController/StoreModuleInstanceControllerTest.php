<?php


namespace Tests\Integration\Http\Requests\Api\ModuleInstanceController;


use BristolSU\Support\Activity\Activity;
use BristolSU\Support\Logic\Logic;
use BristolSU\Support\User\User;
use Tests\TestCase;

class StoreModuleInstanceControllerTest extends TestCase
{

    // TODO
    /** @test */
    public function needs_testing(){
        $this->assertTrue(true);
    }
//
//    private $user;
//
//    public function setUp(): void
//    {
//        parent::setUp();
//        $this->user = factory(User::class)->create();
//        $this->be($this->user);
//    }
//
//    public function storeModuleInstance($parameters=[])
//    {
//
//        $parameters = array_merge([
//            'alias' => 'alias1',
//            'activity_id' => factory(Activity::class)->create()->id,
//            'name' => 'somedefaultname',
//            'description' => 'Some default description',
//            'active' => factory(Logic::class)->create()->id,
//            'visible' => factory(Logic::class)->create()->id,
//            'mandatory' => factory(Logic::class)->create()->id,
//            'complete' => config('alias1.completion')[0]['event']
//        ], $parameters);
//
//        return $this->post('/admin/settings/moduleinstance', $parameters);
//    }
//
//    /** @test */
//    public function it_returns_a_validation_error_for_an_invalid_module_alias(){
//        $response = $this->storeModuleInstance(['alias' => 'invalid']);
//        $response->assertSessionHasErrors('alias');
//    }
//
//    /** @test */
//    public function it_returns_a_validation_error_if_the_module_alias_is_null(){
//        $response = $this->storeModuleInstance(['alias' => null]);
//        $response->assertSessionHasErrors('alias');
//    }
//
//    /** @test */
//    public function it_returns_a_validation_error_if_the_activity_id_is_null(){
//        $response = $this->storeModuleInstance(['activity_id' => null]);
//        $response->assertSessionHasErrors('activity_id');
//    }
//
//    /** @test */
//    public function it_returns_a_validation_error_if_the_activity_id_is_not_found(){
//        $response = $this->storeModuleInstance(['activity_id' => 1000000]);
//        $response->assertSessionHasErrors('activity_id');
//    }
//
//    /** @test */
//    public function it_returns_a_validation_error_if_the_name_is_null(){
//        $response = $this->storeModuleInstance(['name' => null]);
//        $response->assertSessionHasErrors('name');
//    }
//
//    /** @test */
//    public function it_returns_a_validation_error_if_the_description_is_null(){
//        $response = $this->storeModuleInstance(['description' => null]);
//        $response->assertSessionHasErrors('description');
//    }
//
//    /** @test */
//    public function it_returns_a_validation_error_if_the_visible_id_is_null(){
//        $response = $this->storeModuleInstance(['visible' => null]);
//        $response->assertSessionHasErrors('visible');
//    }
//
//    /** @test */
//    public function it_returns_a_validation_error_if_the_visible_id_is_not_found(){
//        $response = $this->storeModuleInstance(['visible' => 1000000]);
//        $response->assertSessionHasErrors('visible');
//    }
//
//    /** @test */
//    public function it_returns_a_validation_error_if_the_active_id_is_null(){
//        $response = $this->storeModuleInstance(['active' => null]);
//        $response->assertSessionHasErrors('active');
//    }
//
//    /** @test */
//    public function it_returns_a_validation_error_if_the_active_id_is_not_found(){
//        $response = $this->storeModuleInstance(['active' => 1000000]);
//        $response->assertSessionHasErrors('active');
//    }
//
//    /** @test */
//    public function it_returns_a_validation_error_if_the_mandatory_id_is_null(){
//        $response = $this->storeModuleInstance(['mandatory' => null]);
//        $response->assertSessionHasErrors('mandatory');
//    }
//
//    /** @test */
//    public function it_returns_a_validation_error_if_the_mandatory_id_is_not_found(){
//        $response = $this->storeModuleInstance(['mandatory' => 1000000]);
//        $response->assertSessionHasErrors('mandatory');
//    }
//
//    /** @test */
//    public function it_returns_a_validation_error_if_the_complete_is_not_registered(){
//        $response = $this->storeModuleInstance(['complete'=>'notanactivity']);
//        $response->assertSessionHasErrors('complete');
//    }
//
//    /** @test */
//    public function it_does_not_return_a_validation_error_if_the_complete_is_null(){
//        $response = $this->storeModuleInstance(['complete'=>null]);
//        $response->assertStatus(201);
//    }
//
//    /** @test */
//    public function it_returns_201_if_module_instance_created(){
//        $response = $this->storeModuleInstance();
//        $id = json_decode($response->content(), true)['id'];
//        $this->assertDatabaseHas('module_instances', ['id' => $id]);
//        $response->assertStatus(201);
//    }


}
