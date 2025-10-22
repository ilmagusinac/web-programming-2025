<?php
require_once 'BaseService.php';
require_once(__DIR__ . '/../dao/CourseDao.php');

class CourseService extends BaseService {

   public function __construct() {
       $dao = new CourseDao();
       parent::__construct($dao);
   }

   public function createCourse($course_name, $credits) {
       return $this->dao->createCourse($course_name, $credits);
   }
}
?>
