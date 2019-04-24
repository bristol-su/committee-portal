<?php

namespace App\Jobs;

use ActiveResource\ConnectionManager;
use App\Packages\ControlDB\Models\Student;
use App\Packages\ControlDB\Models\StudentTag;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AddTagToStudent implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    public $student;

    public $studentTag;

    public $data;

    /**
     * AddTagToStudent constructor.
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
        $request = $connection->buildRequest('post', 'students/' . $this->student->id . '/student_tags', [], json_encode([
            'id' => [$this->studentTag->id],
            'data' => [json_encode($this->data)]
        ]));
        $response = $connection->send($request);

        // Parse the response by hydrating the model
        if (!$response->isSuccessful()) {
            throw new \Exception(
                'Error tagging a student. User ID ' . $this->student->id . ' and student tag ID ' . $this->studentTag->id,
                $response->getStatusCode()
            );
        }
    }
}
