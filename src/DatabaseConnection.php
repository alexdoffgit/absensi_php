<?php

namespace Attendance;

use \PDO;
use Attendance\Errors\EnvNotLoadedError;
use Attendance\Errors\ServerError;
use \PDOException;

class DatabaseConnection {
    private function __construct() {}

    /**
     * @return \PDO
     * @throws Attendance\Errors\ServerError
     */
    public static function getConnection()
    {
        try {
            $envs = self::getEnv();
            $conn = new PDO("mysql:host={$envs['serverhost']};dbname={$envs['dbname']};port={$envs['port']}", $envs['username'], $envs['password']);
            return $conn;
        } 
        catch (EnvNotLoadedError $envNotLoadedError) {
            error_log($envNotLoadedError->getMessage());
            throw new ServerError($envNotLoadedError);
        }
        catch (PDOException $pdoException) {
            error_log($pdoException->getMessage());
            throw new ServerError($pdoException);
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            throw new ServerError($th);
        }
    }

    /**
     * @return array{
     *   serverhost: string,
     *   port: int,
     *   dbname: string,
     *   username: string,
     *   password: string|null
     * }
     * @throws Attendance\Errors\EnvNotLoadedError
     */
    private static function getEnv()
    {
        $envMapping = [
            'SERVER_HOST' => 'serverhost',
            'PORT' => 'port',
            'DATABASE_NAME' => 'dbname',
            'DATABASE_USERNAME' => 'username',
            'DATABASE_PASSWORD' => 'password'
        ];
        $envs = [];

        foreach ($envMapping as $usedEnv => $key) {
            if (array_key_exists($usedEnv, $_ENV)) {
                $envs[$key] = $_ENV[$usedEnv];
            } else {
                throw new EnvNotLoadedError($usedEnv);
            }
        }

        return $envs;
    }
}