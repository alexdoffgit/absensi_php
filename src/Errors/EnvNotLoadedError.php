<?php

namespace Attendance\Errors;

use \Exception;

class EnvNotLoadedError extends Exception {
    /**
     * the environment variable key that cannot be loaded
     * @param string $key
     */
    public function __construct($key)
    {
        parent::__construct("can't load env variable key {$key}", 0, null);
    }
}