<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class StudentHasNoPositions extends Exception
{
    public function __construct(string $message = 'Couldn\'t find any groups in which you\'re registered as committee.', int $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
