<?php

use PHPUnit\Framework\TestCase;

class StudentTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        require_once __DIR__ . '/../vendor/autoload.php';

        // Fake decoded JWT user for tests
        $fakeUser = (object)[
            "id" => 1,
            "name" => "Test User",
            "email" => "test@example.com",
            "role" => "admin",        // full permissions
            "permissions" => ["*"]    // allow everything
        ];

        // Mock auth middleware BEFORE index.php is loaded
        Flight::map('auth_middleware', function () use ($fakeUser) {
            return new class($fakeUser)
            {
                private $fakeUser;

                public function __construct($fakeUser)
                {
                    $this->fakeUser = $fakeUser;
                }

                public function verifyToken($token = null)
                {
                    // Simulate successful verification
                    Flight::set('user', $this->fakeUser);
                    Flight::set('jwt_token', 'fake-token');
                    return true;
                }

                public function authorizeRole($requiredRole)
                {
                    // Always allow
                    return true;
                }

                public function authorizeRoles($roles)
                {
                    // Always allow
                    return true;
                }

                public function authorizePermission($permission)
                {
                    // Always allow
                    return true;
                }
            };
        });

        // Fake authorization header
        $_SERVER['HTTP_AUTHORIZATION'] = "Bearer faketoken";

        // Load application (routes, services, middleware)
        require_once __DIR__ . '/../index.php';

        // Disable exit()
        Flight::halt(false);
    }

    private function runRoute($method, $uri, $body = null)
    {
        $_SERVER['REQUEST_METHOD'] = $method;
        $_SERVER['REQUEST_URI'] = $uri;

        // Inject JSON body for POST/PUT
        if ($body !== null) {
            $stream = fopen('php://memory', 'r+');
            fwrite($stream, json_encode($body));
            rewind($stream);
            Flight::request()->body = $stream;
        }

        ob_start();
        Flight::router()->route();
        return ob_get_clean();
    }

    public function testGetAllStudents()
    {
        $output = $this->runRoute('GET', '/student');

        $this->assertEquals(200, http_response_code());
        $this->assertJson($output);
    }

    public function testGetStudentById()
    {
        $output = $this->runRoute('GET', '/student/1');

        $this->assertEquals(200, http_response_code());
        $this->assertJson($output);
    }

    public function testGetStudentByEmail()
    {
        $output = $this->runRoute('GET', '/student/john@gmail.com');

        $this->assertEquals(200, http_response_code());
        $this->assertJson($output);
    }

    public function testCreateStudent()
    {
        $output = $this->runRoute('POST', '/student', [
            "name"     => "Test User",
            "email"    => "testuser@gmail.com",
            "password" => "12345"
        ]);

        $this->assertEquals(200, http_response_code());
        $this->assertJson($output);
    }

    public function testUpdateStudent()
    {
        $output = $this->runRoute('PUT', '/student/1', [
            "name"     => "Updated User",
            "email"    => "updated@gmail.com",
            "password" => "newpass"
        ]);

        $this->assertEquals(200, http_response_code());
        $this->assertJson($output);
    }

    public function testDeleteStudent()
    {
        $output = $this->runRoute('DELETE', '/student/1');

        $this->assertEquals(200, http_response_code());
        $this->assertJson($output);
    }
}
