<?php


namespace Tests\Unit\Support\Control\Client;


use App\Support\Control\Client\Token;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use Prophecy\Argument;
use Tests\TestCase;

class TokenTest extends TestCase
{

    /** @test */
    public function it_sends_a_post_request_to_get_a_token(){
        $client = $this->prophesize(Client::class);
        $response = new Response(200, [], json_encode(['access_token' => 'SecretToken', 'expires_in' => 1]));
        $client->post(config('control.base_uri') . '/oauth/token', Argument::type('array'))->shouldBeCalled()->willReturn($response);

        $token = new Token($client->reveal());
        $token->token(true);
    }

    /** @test */
    public function it_parses_a_post_request(){
        $client = $this->prophesize(Client::class);
        $response = new Response(200, [], json_encode(['access_token' => 'SecretToken', 'expires_in' => 1]));
        $client->post(config('control.base_uri') . '/oauth/token', Argument::type('array'))->shouldBeCalled()->willReturn($response);

        $token = new Token($client->reveal());
        $accessToken = $token->token(true);
        $this->assertEquals('SecretToken', $accessToken);
    }


}
