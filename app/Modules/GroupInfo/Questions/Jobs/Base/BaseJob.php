<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 23/03/19
 * Time: 14:38
 */

namespace App\Modules\GroupInfo\Jobs\Job\Base;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

// TODO Extract this to a database

abstract class BaseJob implements ShouldQueue
{

    use Dispatchable, Queueable, SerializesModels;

    public $data;

    public $group;

    public function __construct($data)
    {
        $this->data = $data;

        $this->group = Auth::user()->getCurrentRole()->group;
    }

    public function handle()
    {
        Log::info(json_encode($this->data));
    }
}