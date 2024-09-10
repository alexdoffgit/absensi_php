<?php

namespace Tests\Browser;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Firefox\FirefoxOptions;

class Setup {
    private static $driver;

    public static function getDriver() 
    {
        if (self::$driver === null) {
            $host = 'http://localhost:4444';
    
            $options = new FirefoxOptions();
            $options->setOption('binary', 'C:\\Program Files\\Mozilla Firefox\\firefox.exe');
    
            $capabilities = DesiredCapabilities::firefox();
            $capabilities->setCapability(FirefoxOptions::CAPABILITY, $options);
    
            self::$driver = RemoteWebDriver::create($host, $capabilities);
            self::$driver->manage()->window()->maximize();    
        }

        return self::$driver;
    }

    public static function quitDriver()
    {
        if (self::$driver !== null) {
            self::$driver->quit();
            self::$driver = null;
        }
    }
}