<?php

namespace Attendance\Repositories;

use \PDO;
use Attendance\Errors\CredentialsNotFoundError;

class Login {
    public function __construct(private PDO $db) {}

    /**
     * @param string $fullname
     * @return array{fullname: string, password: string}
     * @throws Attendance\Errors\CredentialNotFoundError
     */
    public function getCredentials($fullname)
    {
        $sql = "SELECT fullname, `password` FROM userinfo WHERE fullname = :name";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['name' => $fullname]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            return $user;
        } else {
            throw new CredentialsNotFoundError($fullname);
        }
    }
}