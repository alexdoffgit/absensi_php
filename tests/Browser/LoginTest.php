<?php

namespace Tests\Browser;

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class LoginTest extends TestCase
{
    protected $driver;
    private $baseUrl = 'http://localhost/absensi_php';

    protected function setUp(): void
    {
        $this->driver = Setup::getDriver();
    }

    public function test_login_header_exist()
    {
        $this->driver->get("{$this->baseUrl}/login.php");
        
        $loginHeader = $this->driver->wait()->until(
            WebDriverExpectedCondition::presenceOfElementLocated(
                WebDriverBy::xpath("//h1[text()='Login']")
            )
        );

        $this->assertTrue($loginHeader->isDisplayed());
    }

    public static function tearDownAfterClass(): void
    {
        Setup::quitDriver();
    }
}
