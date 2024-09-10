<?php

namespace Attendance\Services;

use Attendance\Errors\ClientError;
use Attendance\Password;
use Attendance\Repositories\Login as LoginRepository;
use Attendance\Errors\CredentialsNotFoundError;
use Attendance\Errors\ServerError;

class Login {
    public function __construct(
        private LoginRepository $loginRepository, 
        private Password $pass) {}

        /**
         * @param string $fullname
         * @param string $password
         * @return bool
         * @throws Attendance\Errors\ClientError
         * @throws Attendance\Errors\ServerError
         */
    public function verifyCredentials($fullname, $password)
    {
        try {
            $credentials = $this->loginRepository->getCredentials($fullname);
            $passwordValid = $this->pass->verify($password, $credentials['password']);
            return $passwordValid;
        } catch (CredentialsNotFoundError $c) {
            error_log($c->getMessage());
            throw new ClientError("invalid credentials", $c);
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            throw new ServerError($th);
        }
    }
}