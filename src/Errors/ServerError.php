<?php

namespace Attendance\Errors;

use \Exception;
use \Throwable;

class ServerError extends Exception {

    /**
     * @param \Throwable|null $e
     */
    public function __construct($th)
    {
        parent::__construct("internal server error", 0, $th);
    }
}