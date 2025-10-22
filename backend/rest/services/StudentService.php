<?php
require_once 'BaseService.php';
require_once(__DIR__ . '/../dao/StudentDao.php');


class StudentService extends BaseService {

    public function __construct() {
        parent::__construct(new StudentDao());
    }

    public function createStudent($name, $email, $password) {
        return $this->dao->createStudent($name, $email, $password);
    }

    public function getByEmail($email) {
        return $this->dao->getByEmail($email);
    }
}
?>
