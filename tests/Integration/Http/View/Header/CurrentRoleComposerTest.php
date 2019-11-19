<?php

namespace Tests\Integration\Http\View\Header;

use App\Http\View\Header\CurrentAuthComposer;
use BristolSU\Support\Authentication\Contracts\Authentication;
use BristolSU\Support\Control\Models\Role;
use Illuminate\Contracts\View\View;
use Tests\TestCase;

class CurrentRoleComposerTest extends TestCase
{

    /** @test */
    public function compose_attaches_the_getRole_result_to_the_view(){
        $role = new Role(['id' => 5]);
        $authentication = $this->prophesize(Authentication::class);
        $authentication->getRole()->shouldBeCalled()->willReturn($role);

        $view = $this->prophesize(View::class);
        $view->with('currentRole', $role)->shouldBeCalled();

        $composer = new CurrentAuthComposer($authentication->reveal());
        $composer->compose($view->reveal());
    }

}
