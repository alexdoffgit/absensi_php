<?php

namespace Alexdoff\Absensix\Repositories;

use \PDO;
use Alexdoff\Absensix\Errors\UserNotFoundError;
use Exception;

class Login {
    public function __construct(private PDO $conn) {}

    /**
     * @param string $fullname
     * @return int
     * @throws Alexdoff\Absensix\Errors\UserNotFoundError
     */
    private function getUserIdByFullname($fullname)
    {
        $sql = "SELECT USERID FROM userinfo WHERE fullname = :fullname";
        $statement = $this->conn->prepare($sql);
        $statement->execute(['fullname' => $fullname]);
        $userIdFromDB = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$userIdFromDB) {
            throw new UserNotFoundError($fullname);
        } else {
            return $userIdFromDB['USERID'];
        }
    }

    /**
     * @param string $fullname
     * @return array{fullname: string, password: string}
     * @throws Alexdoff\Absensix\Errors\UserNotFoundError
     */
    public function getFullnameAndPasswordByFullname($fullname)
    {
        try {
            $userId = $this->getFullnameAndPasswordByFullname($fullname);
            $sql = "SELECT fullname, `password` FROM userinfo WHERE USERID = :id";
            $statement = $this->conn->prepare($sql);
            $statement->execute(['id' => $userId]);
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch(Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }
}