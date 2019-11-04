<?php

namespace Tests\Unit\Exceptions;

use App\Exceptions\Handler;
use BristolSU\Support\Activity\Activity;
use BristolSU\Support\Activity\Exception\ActivityRequiresGroup;
use BristolSU\Support\Activity\Exception\ActivityRequiresRole;
use BristolSU\Support\Activity\Exception\ActivityRequiresUser;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Tests\TestCase;

class HandlerTest extends TestCase
{

    /** @test */
    public function it_redirects_to_user_login_if_exception_is_ActivityRequiresUser(){
        $request = $this->prophesize(Request::class);
        $request->expectsJson()->willReturn(false);
        $request->fullUrl()->shouldBeCalled()->willReturn('https://example.com');

        $activity = factory(Activity::class)->create();
        $exception = new ActivityRequiresUser('Message', 403, null, $activity);

        $handler = new Handler(app());
        $response = TestResponse::fromBaseResponse($handler->render($request->reveal(), $exception));

        $response->assertRedirect('http://portal.local/login/user/' . $activity->slug . '?redirect=https%3A%2F%2Fexample.com');
    }

    /** @test */
    public function it_redirects_to_group_login_if_exception_is_ActivityRequiresGroup(){
        $request = $this->prophesize(Request::class);
        $request->expectsJson()->willReturn(false);
        $request->fullUrl()->shouldBeCalled()->willReturn('https://example.com');

        $activity = factory(Activity::class)->create();
        $exception = new ActivityRequiresGroup('Message', 403, null, $activity);

        $handler = new Handler(app());
        $response = TestResponse::fromBaseResponse($handler->render($request->reveal(), $exception));

        $response->assertRedirect('http://portal.local/login/group/' . $activity->slug . '?redirect=https%3A%2F%2Fexample.com');
    }

    /** @test */
    public function it_redirects_to_role_login_if_exception_is_ActivityRequiresRole(){
        $request = $this->prophesize(Request::class);
        $request->expectsJson()->willReturn(false);
        $request->fullUrl()->shouldBeCalled()->willReturn('https://example.com');

        $activity = factory(Activity::class)->create();
        $exception = new ActivityRequiresRole('Message', 403, null, $activity);

        $handler = new Handler(app());
        $response = TestResponse::fromBaseResponse($handler->render($request->reveal(), $exception));

        $response->assertRedirect('http://portal.local/login/role/' . $activity->slug . '?redirect=https%3A%2F%2Fexample.com');
    }

    /** @test */
    public function it_throws_an_exception_in_json(){

        $request = $this->prophesize(Request::class);
        $request->expectsJson()->willReturn(true);

        $activity = factory(Activity::class)->create();
        $exception = new ActivityRequiresUser('Message', 403, null, $activity);

        $handler = new Handler(app());
        $response = TestResponse::fromBaseResponse($handler->render($request->reveal(), $exception));

        $response->assertJson([
            'message' => 'Message',
            'exception' => 'BristolSU\\Support\\Activity\\Exception\\ActivityRequiresUser'
        ]);
    }

}
