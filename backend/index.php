<?php
require 'vendor/autoload.php';
require __DIR__ . '/rest/services/AuthService.php';
require_once __DIR__ . '/rest/services/StudentService.php';
require_once __DIR__ . '/middleware/AuthMiddleware.php';
require_once __DIR__ . '/data/roles.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;


ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


Flight::route('/', function(){  
   echo 'Hello world!';
});

Flight::register('studentService', 'StudentService');
Flight::register('auth_service', "AuthService");
Flight::register('auth_middleware', "AuthMiddleware");

Flight::before('start', function(&$params, &$output){
    $url = Flight::request()->url;

    // public routes (no token required)
    if (
        str_starts_with($url, '/auth/login') ||
        str_starts_with($url, '/auth/register')
    ) {
        return TRUE;
    }

    try {
        $authHeader = Flight::request()->getHeader("Authorization");
        /*
        if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            Flight::halt(401, "Missing or invalid Authorization header");
        }

        $token = $matches[1];
        $decoded_token = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));

        // Save user info globally
        Flight::set('user', $decoded_token->user);
        Flight::set('jwt_token', $token);
        return TRUE;
        */

        if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            Flight::halt(401, "Missing or invalid Authorization header");
        }

        $token = $matches[1];

        Flight::auth_middleware()->verifyToken($token);

    } catch (Exception $e) {
        Flight::halt(401, "Invalid or expired token: " . $e->getMessage());
    }
});


require_once __DIR__ .'/rest/routes/AuthRoutes.php';
require_once __DIR__ . '/rest/routes/StudentRoutes.php';

Flight::start();
?>
