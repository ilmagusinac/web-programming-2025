<?php
require_once 'BaseService.php';
require_once(__DIR__ . '/../dao/EnrollmentDao.php');


class EnrollmentService extends BaseService {

    public function __construct() {
        parent::__construct(new EnrollmentDao());
    }

    public function enrollStudent($student_id, $course_id) {
        return $this->dao->enrollStudent($student_id, $course_id);
    }

    public function getAllEnrollments() {
        return $this->dao->getAllEnrollments();
    }
}
?>
