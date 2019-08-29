<?php


namespace App\Support\DataPlatform\Repositories;


use App\Support\DataPlatform\Contracts\Models\User as UserModelContract;
use App\Support\DataPlatform\Contracts\Repositories\User as UserRepositoryContract;
use Twigger\UnionCloud\API\Exception\Resource\ResourceNotFoundException;
use Twigger\UnionCloud\API\UnionCloud;

class User implements UserRepositoryContract
{

    /**
     * @var UnionCloud
     */
    private $unionCloud;

    public function __construct(UnionCloud $unionCloud)
    {
        $this->unionCloud = $unionCloud;
    }

    public function getByIdentity($identity) : UserModelContract
    {
        try {
            return $this->getByEmail($identity);
        } catch (ResourceNotFoundException $e) {
            return $this->getByStudentID($identity);
        }
    }

    public function getByEmail($email): UserModelContract
    {
        $user = $this->unionCloud->users()->search(['email' => $email], true)->get()->first();
        return new \App\Support\DataPlatform\Models\User($user->getOriginalAttributes());
    }

    public function getByStudentID($studentId): UserModelContract
    {
        $user = $this->unionCloud->users()->search(['id' => $studentId])->get()->first();
        return new \App\Support\DataPlatform\Models\User($user->getOriginalAttributes());
    }
}
