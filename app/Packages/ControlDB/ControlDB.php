<?php

namespace App\Packages\ControlDB;

use App\Exceptions\StudentHasNoPositions;
use GuzzleHttp\Client;
use function GuzzleHttp\Psr7\get_message_body_summary;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ControlDB implements ControlDBInterface
{

    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    private function getAuthToken($refresh=false)
    {
        // Check if present in cache
        if(Cache::has('authentication:control:auth_token') && ! $refresh)
        {
            return Cache::get('authentication:control:auth_token');
        }

        $http = new Client;

        $response = $http->post(config('control.base_uri').'/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => config('control.client_id'),
                'client_secret' => config('control.client_secret'),
                'username' => config('control.email'),
                'password' => config('control.password'),
                'scope' => '*',
            ],
        ]);
        $token = json_decode((string) $response->getBody(), true);
        Cache::put('authentication:control:auth_token', $token['access_token'], ((int) $token['expires_in'])/60);

        return $token['access_token'];

    }

    /**
     * @param $method
     * @param $url
     * @param null $body
     * @param bool $refreshAuth
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function sendRequest($method, $url, $body=null, $refreshAuth=false)
    {

        $cacheKey = 'control:request:parameters.'.$method.'.'.htmlspecialchars($url).'.'.htmlspecialchars( (is_array($body)?json_encode($body):$body));


        if(Cache::has($cacheKey) && !$refreshAuth)
        {
            return json_decode(Cache::get($cacheKey));
        }

        try{
            $response = $this->client->request(
                $method,
                config('control.base_uri').'/api/'.$url,
                [
                    'json' =>(is_array($body)?json_encode($body):$body),
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$this->getAuthToken()
                    ],
                    'http_errors' => true,
                ]
            );
        } catch (\Exception $e)
        {
            if($e->getCode() === 401 && ! $refreshAuth)
            {
                $response = $this->sendRequest($method, $url, $body, true);
            } else {
                throw $e;
            }
        }
        if($refreshAuth) { return $response; }

        Cache::put($cacheKey, $response->getBody()->getContents(), 60);

        return json_decode($response->getBody()->getContents());
    }

    /**
     * @param int $studentId
     * @return mixed
     * @throws StudentHasNoPositions
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPositionsFromStudent(int $studentId)
    {
        $positions = $this->sendRequest(
            'GET',
            'students/'.$studentId.'/positions'
        );

        if(count($positions) === 0)
        {
            throw new StudentHasNoPositions();
        }
        return $positions;
    }

    public function getGroupByID($id)
    {
        return $this->sendRequest(
            'GET',
            'groups/'.$id
        );
    }


    public function getPositions()
    {

        return $this->sendRequest(
            'GET',
            'positions'
        );

    }

    public function getSpecificPosition($position_id)
    {

        $positions = $this->getPositions();
        foreach($positions as $position)
        {
            if($position->id === $position_id)
            {
                return $position;
            }
        }

        return [];
    }

    public function getAllGroups()
    {
        return $this->sendRequest('GET', 'groups');
    }
}
