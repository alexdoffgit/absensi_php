<?php

namespace Alexdoff\Absensix\Errors;

use \Exception;

class InvalidCredentialError extends Exception {
    public function __construct()
    {
        parent::__construct("invalid credential", 0, null);
    }
}