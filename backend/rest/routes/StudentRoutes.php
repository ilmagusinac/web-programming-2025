<?php

/**
 * @OA\Get(
 *     path="/student",
 *     tags={"students"},
 *     summary="Get all students",
 *     security={{"BearerAuth": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="List of all students"
 *     )
 * )
 */
Flight::route('GET /student', function() {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::studentService()->getAll());
});

/**
 * @OA\Get(
 *     path="/student/{id}",
 *     tags={"students"},
 *     summary="Get student by ID",
 *     security={{"BearerAuth": {}}},
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
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::studentService()->getById($id));
});

/**
 * @OA\Get(
 *     path="/student/{email}",
 *     tags={"students"},
 *     summary="Get student by email",
 *     security={{"BearerAuth": {}}},
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
Flight::route('GET /student/email/@email', function($email) {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::studentService()->getByEmail($email));
});

/**
 * @OA\Post(
 *     path="/student",
 *     tags={"students"},
 *     security={{"BearerAuth": {}}},
 *     summary="Create a new student",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "email", "password"},
 *             @OA\Property(property="name", type="string", example="John Doe"),
 *             @OA\Property(property="email", type="string", example="ima@gmail.com"),
 *             @OA\Property(property="password", type="string", example="ima"),
 *             @OA\Property(property="role", type="string", example="admin"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Student created successfully"
 *     )
 * )
 */
Flight::route('POST /student', function() {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    //$data = Flight::request()->data->getData();
    $data = json_decode(Flight::request()->getBody(), true);
    $role = $data['role'] ?? "user";
    Flight::json(
        Flight::studentService()->createStudent(
            $data['name'],
            $data['email'],
            $data['password'],
            $role
        )
    );
    error_log("BODY: " . Flight::request()->getBody());
});

/**
 * @OA\Put(
 *     path="/student/{id}",
 *     tags={"students"},
 *     summary="Update an existing student",
 *     security={{"BearerAuth": {}}},
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
 *             @OA\Property(property="password", type="string", example="newpassword123"),
 *             @OA\Property(property="role", type="string", example="admin"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Student updated successfully"
 *     )
 * )
 */
Flight::route('PUT /student/@id', function($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    //$data = Flight::request()->data->getData();
    $data = json_decode(Flight::request()->getBody(), true);
    Flight::json(Flight::studentService()->updateStudent($id, $data));
});

/**
 * @OA\Delete(
 *     path="/student/{id}",
 *     tags={"students"},
 *     summary="Delete a student by ID",
 *     security={{"BearerAuth": {}}},
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
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json(Flight::studentService()->delete($id));
});
?>
