<?php

namespace Attendance\Errors;

use \Exception;
use \Throwable;

class ClientError extends Exception {
    /**
     * @param string $message
     * @param \Throwable|null $th
     */
    public function __construct($message, $th)
    {
        parent::__construct($message, 0, $th);
    }
}