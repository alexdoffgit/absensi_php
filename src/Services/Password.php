<?php

namespace Alexdoff\Absensix\Services;
use RuntimeException;

class Password {
    private $cost = 12;
    private $verifyAlgorithm = false;
    
    public function hash(string $plainTextPassword): string
    {
        $hashedPassword = password_hash($plainTextPassword, PASSWORD_BCRYPT, [
            'cost' => $this->cost
        ]);

        if ($hashedPassword === false) {
            throw new RuntimeException('Bcrypt hashing not supported.');
        }

        return $hashedPassword;
    }

    public function comparePlainWithHashedPassword(
        string $plainTextPassword,
        string $hashedPassword
    ) {
        if ($this->verifyAlgorithm && ! $this->isUsingCorrectAlgorithm($hashedPassword)) {
            throw new RuntimeException('This password does not use the Bcrypt algorithm.');
        }

        return password_verify($plainTextPassword, $hashedPassword);
    }

    private function isUsingCorrectAlgorithm($hashedValue)
    {
        $passwordInfo = password_get_info($hashedValue);
        return $passwordInfo['algoName'] === 'bcrypt';
    }
}