<?php

namespace Alexdoff\Absensix\Services;

use Alexdoff\Absensix\Repositories\Login as LoginRepository;
use Alexdoff\Absensix\Errors\InvalidCredentialError;
use \Exception;

class Login {
    public function __construct(
        private LoginRepository $loginRepository,
        private Password $passwordService
    ) {}

    /**
     * @param string $fullname
     * @param string $password
     * @return bool
     * @throws Alexdoff\Absensix\Errors\UserNotFoundError
     * @throws Alexdoff\Absensix\Errors\InvalidCredentialError
     */
    public function verifyUser($fullname, $password)
    {
        try {
            $userCredentials = $this->loginRepository->getFullnameAndPasswordByFullname($fullname);
            $passwordIsValid = $this->passwordService->comparePlainWithHashedPassword($password, $userCredentials['password']);
            if ($passwordIsValid) {
                return true;
            } else {
                throw new InvalidCredentialError();
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }
}