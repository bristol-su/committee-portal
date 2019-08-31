<?php

namespace App\Modules\FileUpload\Events;

use App\Support\Authentication\Contracts\Authentication;
use App\Support\EventStore\Contracts\StorableEvent;
use App\User;
use Illuminate\Foundation\Events\Dispatchable;

class DocumentSubmitted implements StorableEvent
{
    use Dispatchable;

    private $moduleInstanceId;

    /**
     * Create a new event instance.
     *
     * @param $moduleInstanceId
     */
    public function __construct($moduleInstanceId)
    {
        $this->moduleInstanceId = $moduleInstanceId;
    }

    public function moduleInstanceId(): int
    {
        return $this->moduleInstanceId;
    }

    public function userId(): int
    {
        return User::first()->id;
    }

    public function groupId(): ?int
    {
        return null;
    }

    public function roleId(): ?int
    {
        return null;
    }

    public function keywords(): array
    {
        return ['foo', 'bar'];
    }
}
