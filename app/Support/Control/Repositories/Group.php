<?php


namespace App\Support\Control\Repositories;


use App\Support\Control\Contracts\Client\Client as ControlClient;
use App\Support\Control\Contracts\Repositories\Group as GroupContract;

class Group implements GroupContract
{

    /**
     * @var ControlClient
     */
    private $client;

    public function __construct(ControlClient $client)
    {
        $this->client = $client;
    }

    public function getById($id)
    {
        $response = $this->client->request(
            'get',
            'groups/' . $id
        );

        return new \App\Support\Control\Models\Group($response);
    }

}
