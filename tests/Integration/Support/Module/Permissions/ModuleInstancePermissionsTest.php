<?php


namespace Tests\Integration\Support\Module\Permissions;


use App\Support\Event\Event;
use App\Support\Logic\Contracts\LogicTester;
use App\Support\Logic\Logic;
use App\Support\Module\Module\Permissions\ModuleInstancePermissions;
use App\Support\Module\ModuleInstance\ModuleInstance;
use App\User;
use Prophecy\Argument;
use Tests\TestCase;

class ModuleInstancePermissionsTest extends TestCase
{

    /** @test */
    public function it_returns_null_if_the_ability_has_no_dots(){
        $this->assertNull(
            ModuleInstancePermissions::parseAbility('1')
        );
    }

    /** @test */
    public function it_returns_null_if_the_ability_has_three_dots(){
        $this->assertNull(
            ModuleInstancePermissions::parseAbility('1.admin.not.valid')
        );
    }

    /** @test */
    public function it_returns_null_if_the_first_parameter_is_not_an_integer(){
        $this->assertNull(
            ModuleInstancePermissions::parseAbility('notanint.admin.ability')
        );
    }

    /** @test */
    public function it_returns_null_if_the_second_parameter_is_not_admin_or_participant(){
        $this->assertNull(
            ModuleInstancePermissions::parseAbility('1.notadmin.ability')
        );
    }

    /** @test */
    public function it_returns_an_array_if_the_ability_is_valid(){
        $this->assertIsArray(
            ModuleInstancePermissions::parseAbility('1.admin.ability')
        );
    }

    /** @test */
    public function it_returns_null_if_the_module_instance_not_found(){
        $user = factory(User::class)->create();
        $this->assertNull(
            ModuleInstancePermissions::passes($user, '100.admin.ability')
        );
    }

    /** @test */
    public function it_returns_null_if_the_module_instance_has_no_permissions_attached(){
        $moduleInstance = factory(ModuleInstance::class)->create([
            'module_instance_permissions_id' => null
        ]);
        $user = factory(User::class)->create();

        $this->assertNull(
            ModuleInstancePermissions::passes($user, $moduleInstance->id.'.admin.ability')
        );
    }

    /** @test */
    public function it_returns_null_if_the_permission_is_not_in_the_array(){
        $logic = factory(Logic::class)->create();
        $user = factory(User::class)->create();
        $moduleInstancePermissions = factory(ModuleInstancePermissions::class)->create([
            'admin_permissions' => ['permissionone' => $logic->id]
        ]);
        $moduleInstance = factory(ModuleInstance::class)->create([
            'module_instance_permissions_id' => $moduleInstancePermissions->id
        ]);
        $this->assertNull(
            ModuleInstancePermissions::passes($user, $moduleInstance->id.'.admin.permissioninvalid')
        );
    }
    
    /** @test */
    public function it_returns_null_if_the_logic_is_not_found(){
        $user = factory(User::class)->create();
        $moduleInstancePermissions = factory(ModuleInstancePermissions::class)->create([
            'admin_permissions' => ['permissionone' => 100]
        ]);
        $moduleInstance = factory(ModuleInstance::class)->create([
            'module_instance_permissions_id' => $moduleInstancePermissions->id
        ]);
        $this->assertNull(
            ModuleInstancePermissions::passes($user, $moduleInstance->id.'.admin.permissionone')
        );
    }

    /** @test */
    public function it_returns_true_if_the_admin_is_in_a_permission_logic_group(){
        $logic = factory(Logic::class)->create();
        $user = factory(User::class)->create();
        $logicTester = $this->prophesize(LogicTester::class);
        $logicTester->evaluate(Argument::that(function($logicArgument) use ($logic) {
            return $logicArgument->id === $logic->id;
        }))->shouldBeCalled()->willReturn(true);
        $this->instance(LogicTester::class, $logicTester->reveal());

        $moduleInstancePermissions = factory(ModuleInstancePermissions::class)->create([
            'admin_permissions' => ['permissionone' => $logic->id]
        ]);
        $moduleInstance = factory(ModuleInstance::class)->create([
            'module_instance_permissions_id' => $moduleInstancePermissions->id
        ]);

        $this->assertTrue(
            ModuleInstancePermissions::passes($user, $moduleInstance->id.'.admin.permissionone')
        );
    }

    /** @test */
    public function it_returns_true_if_the_participant_is_in_a_permission_logic_group(){
        $logic = factory(Logic::class)->create();
        $user = factory(User::class)->create();
        $logicTester = $this->prophesize(LogicTester::class);
        $logicTester->evaluate(Argument::that(function($logicArgument) use ($logic) {
            return $logicArgument->id === $logic->id;
        }))->shouldBeCalled()->willReturn(true);
        $this->instance(LogicTester::class, $logicTester->reveal());

        $moduleInstancePermissions = factory(ModuleInstancePermissions::class)->create([
            'participant_permissions' => ['permissionone' => $logic->id]
        ]);
        $moduleInstance = factory(ModuleInstance::class)->create([
            'module_instance_permissions_id' => $moduleInstancePermissions->id
        ]);

        $this->assertTrue(
            ModuleInstancePermissions::passes($user, $moduleInstance->id.'.participant.permissionone')
        );
    }

    /** @test */
    public function it_returns_false_if_the_admin_is_not_in_a_permission_logic_group(){
        $logic = factory(Logic::class)->create();
        $user = factory(User::class)->create();
        $logicTester = $this->prophesize(LogicTester::class);
        $logicTester->evaluate(Argument::that(function($logicArgument) use ($logic) {
            return $logicArgument->id === $logic->id;
        }))->shouldBeCalled()->willReturn(false);
        $this->instance(LogicTester::class, $logicTester->reveal());

        $moduleInstancePermissions = factory(ModuleInstancePermissions::class)->create([
            'admin_permissions' => ['permissionone' => $logic->id]
        ]);
        $moduleInstance = factory(ModuleInstance::class)->create([
            'module_instance_permissions_id' => $moduleInstancePermissions->id
        ]);

        $this->assertFalse(
            ModuleInstancePermissions::passes($user, $moduleInstance->id.'.admin.permissionone')
        );
    }

    /** @test */
    public function it_returns_false_if_the_participant_is_not_in_a_permission_logic_group(){
        $logic = factory(Logic::class)->create();
        $user = factory(User::class)->create();
        $logicTester = $this->prophesize(LogicTester::class);
        $logicTester->evaluate(Argument::that(function($logicArgument) use ($logic) {
            return $logicArgument->id === $logic->id;
        }))->shouldBeCalled()->willReturn(false);
        $this->instance(LogicTester::class, $logicTester->reveal());

        $moduleInstancePermissions = factory(ModuleInstancePermissions::class)->create([
            'participant_permissions' => ['permissionone' => $logic->id]
        ]);
        $moduleInstance = factory(ModuleInstance::class)->create([
            'module_instance_permissions_id' => $moduleInstancePermissions->id
        ]);

        $this->assertFalse(
            ModuleInstancePermissions::passes($user, $moduleInstance->id.'.participant.permissionone')
        );
    }

    /** @test */
    public function it_returns_null_if_permission_module_is_not_active_visible_mandatory_or_complete(){
        $user = factory(User::class)->create();

        $moduleInstance = factory(ModuleInstance::class)->create();

        $this->assertNull(
            ModuleInstancePermissions::passes($user, $moduleInstance->id.'.module.notactive')
        );
    }

    /** @test */
    public function it_returns_true_if_active_logic_is_true(){
        $logic = factory(Logic::class)->create();
        $user = factory(User::class)->create();
        $logicTester = $this->prophesize(LogicTester::class);
        $logicTester->evaluate(Argument::that(function($logicArgument) use ($logic) {
            return $logicArgument->id === $logic->id;
        }))->shouldBeCalled()->willReturn(true);
        $this->instance(LogicTester::class, $logicTester->reveal());

        $moduleInstance = factory(ModuleInstance::class)->create([
            'active' => $logic->id
        ]);

        $this->assertTrue(
            ModuleInstancePermissions::passes($user, $moduleInstance->id.'.module.active')
        );
    }

    /** @test */
    public function it_returns_true_if_visible_logic_is_true(){
        $logic = factory(Logic::class)->create();
        $user = factory(User::class)->create();
        $logicTester = $this->prophesize(LogicTester::class);
        $logicTester->evaluate(Argument::that(function($logicArgument) use ($logic) {
            return $logicArgument->id === $logic->id;
        }))->shouldBeCalled()->willReturn(true);
        $this->instance(LogicTester::class, $logicTester->reveal());

        $moduleInstance = factory(ModuleInstance::class)->create([
            'visible' => $logic->id
        ]);

        $this->assertTrue(
            ModuleInstancePermissions::passes($user, $moduleInstance->id.'.module.visible')
        );
    }

    /** @test */
    public function it_returns_true_if_mandatory_logic_is_true(){
        $logic = factory(Logic::class)->create();
        $user = factory(User::class)->create();
        $logicTester = $this->prophesize(LogicTester::class);
        $logicTester->evaluate(Argument::that(function($logicArgument) use ($logic) {
            return $logicArgument->id === $logic->id;
        }))->shouldBeCalled()->willReturn(true);
        $this->instance(LogicTester::class, $logicTester->reveal());

        $moduleInstance = factory(ModuleInstance::class)->create([
            'mandatory' => $logic->id
        ]);

        $this->assertTrue(
            ModuleInstancePermissions::passes($user, $moduleInstance->id.'.module.mandatory')
        );
    }

    /** @test */
    public function it_returns_false_if_active_logic_is_false(){
        $logic = factory(Logic::class)->create();
        $user = factory(User::class)->create();
        $logicTester = $this->prophesize(LogicTester::class);
        $logicTester->evaluate(Argument::that(function($logicArgument) use ($logic) {
            return $logicArgument->id === $logic->id;
        }))->shouldBeCalled()->willReturn(false);
        $this->instance(LogicTester::class, $logicTester->reveal());

        $moduleInstance = factory(ModuleInstance::class)->create([
            'active' => $logic->id
        ]);

        $this->assertFalse(
            ModuleInstancePermissions::passes($user, $moduleInstance->id.'.module.active')
        );
    }

    /** @test */
    public function it_returns_false_if_visible_logic_is_false(){
        $logic = factory(Logic::class)->create();
        $user = factory(User::class)->create();
        $logicTester = $this->prophesize(LogicTester::class);
        $logicTester->evaluate(Argument::that(function($logicArgument) use ($logic) {
            return $logicArgument->id === $logic->id;
        }))->shouldBeCalled()->willReturn(false);
        $this->instance(LogicTester::class, $logicTester->reveal());

        $moduleInstance = factory(ModuleInstance::class)->create([
            'visible' => $logic->id
        ]);

        $this->assertFalse(
            ModuleInstancePermissions::passes($user, $moduleInstance->id.'.module.visible')
        );
    }

    /** @test */
    public function it_returns_false_if_mandatory_logic_is_false(){
        $logic = factory(Logic::class)->create();
        $user = factory(User::class)->create();
        $logicTester = $this->prophesize(LogicTester::class);
        $logicTester->evaluate(Argument::that(function($logicArgument) use ($logic) {
            return $logicArgument->id === $logic->id;
        }))->shouldBeCalled()->willReturn(false);
        $this->instance(LogicTester::class, $logicTester->reveal());

        $moduleInstance = factory(ModuleInstance::class)->create([
            'mandatory' => $logic->id
        ]);

        $this->assertFalse(
            ModuleInstancePermissions::passes($user, $moduleInstance->id.'.module.mandatory')
        );
    }

    /** @test */
    public function it_returns_null_if_the_event_admin_logic_is_not_found(){
        $user = factory(User::class)->create();
        $event = factory(Event::class)->create([
            'admin_logic' => 100
        ]);
        $moduleInstance = factory(ModuleInstance::class)->create([
            'event_id' => $event->id
        ]);
        $this->assertNull(
            ModuleInstancePermissions::passes($user, $moduleInstance->id.'.admin')
        );
    }

    /** @test */
    public function it_returns_null_if_the_event_for_logic_is_not_found(){
        $user = factory(User::class)->create();
        $event = factory(Event::class)->create([
            'for_logic' => 100
        ]);
        $moduleInstance = factory(ModuleInstance::class)->create([
            'event_id' => $event->id
        ]);
        $this->assertNull(
            ModuleInstancePermissions::passes($user, $moduleInstance->id.'.participant')
        );
    }

    /** @test */
    public function it_returns_true_if_the_admin_is_in_the_event_admin_logic(){
        $logic = factory(Logic::class)->create();
        $user = factory(User::class)->create();
        $logicTester = $this->prophesize(LogicTester::class);
        $logicTester->evaluate(Argument::that(function($logicArgument) use ($logic) {
            return $logicArgument->id === $logic->id;
        }))->shouldBeCalled()->willReturn(true);
        $this->instance(LogicTester::class, $logicTester->reveal());
        $event = factory(Event::class)->create([
            'admin_logic' => $logic->id
        ]);

        $moduleInstance = factory(ModuleInstance::class)->create([
            'event_id' => $event->id
        ]);

        $this->assertTrue(
            ModuleInstancePermissions::passes($user, $moduleInstance->id.'.admin')
        );
    }

    /** @test */
    public function it_returns_true_if_the_participant_is_in_the_event_for_logic(){
        $logic = factory(Logic::class)->create();
        $user = factory(User::class)->create();
        $logicTester = $this->prophesize(LogicTester::class);
        $logicTester->evaluate(Argument::that(function($logicArgument) use ($logic) {
            return $logicArgument->id === $logic->id;
        }))->shouldBeCalled()->willReturn(true);
        $this->instance(LogicTester::class, $logicTester->reveal());
        $event = factory(Event::class)->create([
            'for_logic' => $logic->id
        ]);

        $moduleInstance = factory(ModuleInstance::class)->create([
            'event_id' => $event->id
        ]);

        $this->assertTrue(
            ModuleInstancePermissions::passes($user, $moduleInstance->id.'.participant')
        );
    }

    /** @test */
    public function it_returns_false_if_the_admin_is_in_the_event_admin_logic(){
        $logic = factory(Logic::class)->create();
        $user = factory(User::class)->create();
        $logicTester = $this->prophesize(LogicTester::class);
        $logicTester->evaluate(Argument::that(function($logicArgument) use ($logic) {
            return $logicArgument->id === $logic->id;
        }))->shouldBeCalled()->willReturn(false);
        $this->instance(LogicTester::class, $logicTester->reveal());
        $event = factory(Event::class)->create([
            'admin_logic' => $logic->id
        ]);

        $moduleInstance = factory(ModuleInstance::class)->create([
            'event_id' => $event->id
        ]);

        $this->assertFalse(
            ModuleInstancePermissions::passes($user, $moduleInstance->id.'.admin')
        );
    }

    /** @test */
    public function it_returns_false_if_the_participant_is_in_the_event_for_logic(){
        $logic = factory(Logic::class)->create();
        $user = factory(User::class)->create();
        $logicTester = $this->prophesize(LogicTester::class);
        $logicTester->evaluate(Argument::that(function($logicArgument) use ($logic) {
            return $logicArgument->id === $logic->id;
        }))->shouldBeCalled()->willReturn(false);
        $this->instance(LogicTester::class, $logicTester->reveal());
        $event = factory(Event::class)->create([
            'for_logic' => $logic->id
        ]);

        $moduleInstance = factory(ModuleInstance::class)->create([
            'event_id' => $event->id
        ]);

        $this->assertFalse(
            ModuleInstancePermissions::passes($user, $moduleInstance->id.'.participant')
        );
    }

}