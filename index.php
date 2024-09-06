<?php
require 'vendor/autoload.php';

$request = str_replace('/absensi_php', '', $_SERVER['REQUEST_URI']); // this is a hack as i don't create virtual hosts
// $request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$viewDir = '/views/';

switch ($request) {
    case '':
    
    case '/':
        require __DIR__ . $viewDir . 'login.php';
        break;
    
    default:
        http_response_code(404);
        require __DIR__ . $viewDir . '404.php';
        break;
}