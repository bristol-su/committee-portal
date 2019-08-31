<?php


namespace App\Support\Completion;


use App\Support\Authentication\Contracts\Authentication;
use App\Support\Completion\Contracts\CompletionTester as CompletionTesterContract;
use App\Support\EventStore\Contracts\EventStoreRepository;
use App\Support\ModuleInstance\Contracts\ModuleInstance;
use Exception;

class CompletionTester implements CompletionTesterContract
{

    /**
     * @var Authentication
     */
    private $authentication;
    /**
     * @var EventStoreRepository
     */
    private $eventStoreRepository;

    public function __construct(Authentication $authentication, EventStoreRepository $eventStoreRepository)
    {
        $this->authentication = $authentication;
        $this->eventStoreRepository = $eventStoreRepository;
    }

    public function evaluate(ModuleInstance $moduleInstance, $modelId = null): bool
    {
        $for = $moduleInstance->activity->activity_for;
        try {
            return $this->eventStoreRepository->has([
                'module_instance_id' => $moduleInstance->id,
                'event' => $moduleInstance->complete,
                $for . '_id' => ($modelId ?: $this->getModelId($for))
            ]);
        }
        catch (Exception $e) {
            return false;
        }
    }

    public function getModelId($for)
    {
        if ($for === 'user') {
            $model = $this->authentication->getUser();
        } elseif ($for === 'group') {
            $model = $this->authentication->getGroup();
        } else {
            throw new Exception('Activities can only be for users and groups, ' . $for . ' given');
        }
        if($model !== null) {
            return $model->id;
        }
        throw new Exception('User or group not logged in or given.');
    }

}
