<?php
require_once 'BaseDao.php';

class StudentDao extends BaseDao {
    public function __construct() {
        parent::__construct("students");
    }

    public function getByEmail($email) {
        $stmt = $this->connection->prepare("SELECT * FROM students WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function createStudent($name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        return $this->insert([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword
        ]);
    }
}
?>
