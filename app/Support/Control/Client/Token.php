<?php

namespace App\Support\Control\Client;

use App\Support\Control\Contracts\Client\Token as TokenContract;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\Facades\Cache;

class Token implements TokenContract
{

    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function token($refresh = false)
    {
        if (Cache::has(GuzzleClient::class . '@token') && !$refresh) {
            return Cache::get(GuzzleClient::class . '@token');
        }

        $response = $this->client->post(config('control.base_uri') . '/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => config('control.client_id'),
                'client_secret' => config('control.client_secret'),
                'username' => config('control.email'),
                'password' => config('control.password'),
                'scope' => '*',
            ],
        ]);

        $token = json_decode($response->getBody()->getContents(), true);
        Cache::put(GuzzleClient::class . '@token', $token['access_token'], ((int)$token['expires_in']) / 60);

        return $token['access_token'];
    }

}
