<?php
require 'vendor/autoload.php';
require_once __DIR__ . '/rest/services/StudentService.php';


Flight::route('/', function(){  
   echo 'Hello world!';
});

Flight::register('studentService', 'StudentService');


require_once __DIR__ . '/rest/routes/StudentRoutes.php';

Flight::start();
?>
