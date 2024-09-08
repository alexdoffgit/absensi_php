<?php

namespace Tests\Simple;

use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase {
    public function test_process_valid_username_and_password()
    {
        // call code that do login with username and password that are correct. return true
        
        // setup

        $credentialIsValid = $loginService->verifyUser($username, $password);

        $this->assertEquals(true, $credentialIsValid);
    }
}