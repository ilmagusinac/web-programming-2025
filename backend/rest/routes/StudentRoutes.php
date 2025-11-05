<?php

/**
 * @OA\Get(
 *     path="/student",
 *     tags={"students"},
 *     summary="Get all students",
 *     @OA\Response(
 *         response=200,
 *         description="List of all students"
 *     )
 * )
 */
Flight::route('GET /student', function() {
    Flight::json(Flight::studentService()->getAll());
});

/**
 * @OA\Get(
 *     path="/student/{id}",
 *     tags={"students"},
 *     summary="Get student by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the student",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns a student record by ID"
 *     )
 * )
 */
Flight::route('GET /student/@id', function($id) {
    Flight::json(Flight::studentService()->getById($id));
});

/**
 * @OA\Get(
 *     path="/student/{email}",
 *     tags={"students"},
 *     summary="Get student by email",
 *     @OA\Parameter(
 *         name="email",
 *         in="path",
 *         required=true,
 *         description="Email of the student",
 *         @OA\Schema(type="string", example="john@gmail.com")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns a student record by email"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Student not found"
 *     )
 * )
 */
Flight::route('GET /student/@email', function($email) {
    Flight::json(Flight::studentService()->getByEmail($email));
});

/**
 * @OA\Post(
 *     path="/student",
 *     tags={"students"},
 *     summary="Create a new student",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "email", "password"},
 *             @OA\Property(property="name", type="string", example="John Doe"),
 *             @OA\Property(property="email", type="string", example="john@gmail.com"),
 *             @OA\Property(property="password", type="string", example="mypassword123")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Student created successfully"
 *     )
 * )
 */
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

/**
 * @OA\Put(
 *     path="/student/{id}",
 *     tags={"students"},
 *     summary="Update an existing student",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Student ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Updated Name"),
 *             @OA\Property(property="email", type="string", example="updated.email@gmail.com"),
 *             @OA\Property(property="password", type="string", example="newpassword123")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Student updated successfully"
 *     )
 * )
 */
Flight::route('PUT /student/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::studentService()->updateStudent($id, $data));
});

/**
 * @OA\Delete(
 *     path="/student/{id}",
 *     tags={"students"},
 *     summary="Delete a student by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the student to delete",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Student deleted successfully"
 *     )
 * )
 */
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
