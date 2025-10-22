<?php
require_once 'BaseDao.php';

class CourseDao extends BaseDao {
    public function __construct() {
        parent::__construct("courses");
    }

    public function createCourse($course_name, $credits) {
        return $this->insert([
            'course_name' => $course_name,
            'credits' => $credits
        ]);
    }
}
?>
