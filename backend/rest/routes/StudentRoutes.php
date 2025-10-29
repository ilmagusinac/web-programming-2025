<?php

Flight::route('GET /student', function() {
    Flight::json(Flight::studentService()->getAll());
});

Flight::route('GET /student/@id', function($id) {
    Flight::json(Flight::studentService()->getById($id));
});

Flight::route('GET /student/@email', function($email) {
    Flight::json(Flight::studentService()->getByEmail($email));
});

Flight::route('POST /student', function() {
    $data = Flight::request()->data->getData();
    Flight::json(
        Flight::studentService()->createStudent(
            $data['name'],
            $data['email'],
            $data['password']
        )
    );
});

Flight::route('PUT /student/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::studentService()->updateStudent($id, $data));
});


Flight::route('DELETE /student/@id', function($id) {
    Flight::json(Flight::studentService()->delete($id));
});
/*
{
    "id": 1,
    "name": "John Doe",
    "email": "john@gmail.com",
    "password": "$2y$10$Jr2cd9Vd9dH4jkiwh9LE3eJwGgw0pTHy5Kb.58kxhMkNPOg1e98xi",
    "created_at": "2025-10-21 21:54:15"
}
*/
?>
