<?php


namespace App\Support\Control\Client;


use App\Support\Control\Contracts\Client\Client as ControlClientContract;
use App\Support\Control\Contracts\Client\Token;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\Facades\Cache;

class GuzzleClient implements ControlClientContract
{
    /**
     * @var Client
     */
    private $client;

    private $defaultOptions = [];

    public function __construct(ClientInterface $client, Token $token)
    {
        $this->client = $client;
        $this->defaultOptions = [
            'base_uri' => config('control.base_uri') . '/api/',
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token->token()
            ],
        ];
    }

    public function request($method, $uri, array $options = [])
    {
        $response = $this->client->request($method, $uri, array_merge(
            $this->defaultOptions, $options
        ));
        return json_decode($response->getBody()->getContents(), true);
    }
}
