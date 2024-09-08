<?php

namespace Alexdoff\Absensix\Errors;

use \Exception;

class ServerError extends Exception {
    /**
     * @param \Exception|null $exception
     */
    public function __construct($exception)
    {
        parent::__construct("internal server error", 0, $exception);
    }
}