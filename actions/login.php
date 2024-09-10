<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';

use Attendance\DatabaseConnection;
use Attendance\Repositories\Login as LoginRepository;
use Attendance\Services\Login as LoginService;
use Attendance\Errors\ServerError;
use Attendance\Errors\ClientError;
use Attendance\Password;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
        $dotenv->load();
    } catch (\Throwable $dotThrow) {
        error_log($dotThrow->getMessage());
        header("Location: http://localhost/absensi_php/500.php");
        exit;
    }
    $fullname = $_POST['fullname'];
    $password = $_POST['passwd'];

    if (!$fullname) {
        $_SESSION['fullname_error'] = "fullname can't be empty";
        header("Location: {$_SERVER["HTTP_REFERER"]}");
        exit;
    }

    if (!$password) {
        $_SESSION['passwd_error'] = "password can't be empty";
        header("Location: {$_SERVER["HTTP_REFERER"]}");
        exit;
    }

    try {
        $db = DatabaseConnection::getConnection();
        $loginRepo = new LoginRepository($db);
        $pass = new Password();
        $loginService = new LoginService($loginRepo, $pass);
        if ($loginService->verifyCredentials($fullname, $password)) {
            header("Location: http://localhost/absensi_php/attendance.php");
            exit;
        } else {
            $_SESSION['credentials_error'] = "invalid credentials";
            header("Location: {$_SERVER["HTTP_REFERER"]}");
            exit;
        }
        
        $db = null;
    } 
    catch (ClientError $clientError) {
        $_SESSION['client_error'] = $clientError->getMessage();
        header("Location: {$_SERVER["HTTP_REFERER"]}");
        exit;
    }
    catch (ServerError $serverError) {
        error_log($serverError->getMessage());
        header("Location: http://localhost/absensi_php/500.php");
        exit;
    }
    catch (\Throwable $th) {
        error_log($th->getMessage());
        header("Location: http://localhost/absensi_php/500.php");
        exit;
    }
} else {
    header("Location: http://localhost/absensi_php/405.php");
    exit;
}

