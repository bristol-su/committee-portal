<?php


namespace App\Support\Control\Repositories;


use App\Support\Control\Contracts\Client\Client as ControlClient;
use App\Support\Control\Contracts\Models\User as UserModelContract;
use App\Support\Control\Contracts\Repositories\User as UserContract;

class User implements UserContract
{
    /**
     * @var ControlClient
     */
    private $client;

    public function __construct(ControlClient $client)
    {
        $this->client = $client;
    }

    public function findOrCreateByDataId($dataPlatformId): UserModelContract
    {
        // Try and get the user by data platform ID.
        try {
            $user = $this->client->request('post', 'students/search', [
                'form_params' => ['uc_uid' => $dataPlatformId]
            ]);
            $user = $user[0];
        } catch (\Exception $e) {
            $user = $this->client->request('post', 'students', [
                'form_params' => ['uc_uid' => $dataPlatformId]
            ]);
        }

        return new \App\Support\Control\Models\User($user);
    }
}
