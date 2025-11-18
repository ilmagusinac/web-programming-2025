<?php
/**
* @OA\Info(
*     title="API",
*     description="Student API",
*     version="1.0",
*     @OA\Contact(
*         email="ilma.gusinac@ibu.edu.ba",
*         name="Web Programming"
*     )
* )
*/

/**
* @OA\Server(
*     url= "http://localhost/web-programming-2025/backend",
*     description="API server"
* )
*/

/**
 * @OA\SecurityScheme(
 *     securityScheme="BearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Paste your JWT token here in the format: Bearer {token}"
 * )
*/
