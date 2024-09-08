<?php

namespace Alexdoff\Absensix\Errors;

use \Exception;

class UserNotFoundError extends Exception {
    public function __construct($fullname) {
        parent::__construct("user {$fullname} not found", null);
    }
}