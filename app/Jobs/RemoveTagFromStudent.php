<?php

namespace App\Jobs;

use ActiveResource\ConnectionManager;
use App\Packages\ControlDB\Models\Student;
use App\Packages\ControlDB\Models\StudentTag;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RemoveTagFromStudent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $student;

    public $studentTag;

    public $data;

    /**
     * RemoveTagFromStudent constructor.
     * @param Student $student
     * @param StudentTag $studentTag
     * @param $data
     */
    public function __construct(Student $student, StudentTag $studentTag, $data)
    {
        $this->student = $student;
        $this->studentTag = $studentTag;
        $this->data = $data;
    }

    /**
     * @throws \Exception
     */
    public function handle()
    {
        $connection = ConnectionManager::get('control');
        $request = $connection->buildRequest('post', 'students/' . $this->student->id . '/student_tags_relationship/'.$this->studentTag->id.'/delete', [], json_encode($this->data));
        $response = $connection->send($request);

        // Parse the response by hydrating the model
        if (!$response->isSuccessful()) {
            throw new \Exception(
                'Error removing a tag from a student. User ID ' . $this->student->id . ' and student tag ID ' . $this->studentTag->id,
                $response->getStatusCode()
            );
        }
    }
}
