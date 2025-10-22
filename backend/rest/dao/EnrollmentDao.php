<?php
require_once 'BaseDao.php';

class EnrollmentDao extends BaseDao {
    public function __construct() {
        parent::__construct("enrollments");
    }

    public function enrollStudent($student_id, $course_id) {
        return $this->insert([
            'student_id' => $student_id,
            'course_id' => $course_id
        ]);
    }

    public function getAllEnrollments() {
        $sql = "SELECT e.id, s.name AS student_name, c.course_name, e.enrolled_on
                FROM enrollments e
                JOIN students s ON e.student_id = s.id
                JOIN courses c ON e.course_id = c.id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>
