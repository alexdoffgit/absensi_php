<?php

namespace Attendance;

class Password {
    public function hash(string $textPassword): string
    {
        return password_hash($textPassword, PASSWORD_BCRYPT);
    }

    public function verify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}