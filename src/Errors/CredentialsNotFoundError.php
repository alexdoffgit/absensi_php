<?php

namespace Attendance\Errors;

use \Exception;

class CredentialsNotFoundError extends Exception {
    public function __construct($fullname)
    {
        parent::__construct("credential with name {$fullname} not found", 0, null);
    }
}