<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;
use Twigger\UnionCloud\API\Exception\Request\IncorrectRequestParameterException;
use Twigger\UnionCloud\API\UnionCloud;

class SaveStudentInCache implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $uid;

    protected $tries = 5;

    /**
     * SaveStudentInCache constructor.
     *
     * @param $uid
     *
     */
    public function __construct($uid)
    {
        $this->uid = $uid;
    }



    public function handle()
    {
        $cacheKey = 'command:contactsheet:unioncloud:uid.'.$this->uid;

        $unioncloud = app()->make('Twigger\UnionCloud\API\UnionCloud');
        if(!Cache::has($cacheKey)) {
            try {
                $user = $unioncloud->users()->getByUID($this->uid)->get()->first();
                Cache::put('command:contactsheet:unioncloud:uid.'.$this->uid, $this->filterUser($user), 20000);
            } catch (IncorrectRequestParameterException $exception)
            {
                Cache::put('command:contactsheet:unioncloud:uid.'.$this->uid, json_encode([
                    'forename' => 'N/A',
                    'surname' => 'N/A',
                    'email' => 'N/A',
                    'id' => $this->uid,
                    'student_id' => 'N/A'
                ]), 20000);
            }
        }
    }

    private function filterUser($user){
        return json_encode( [
            'forename' => $user->forename,
            'surname' => $user->surname,
            'email' => $user->email,
            'id' => $user->uid,
            'student_id' => $user->id
        ]);

    }
}
