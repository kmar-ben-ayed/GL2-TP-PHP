<?php
include_once 'Repository.php';

class Student extends Repository {
    public function __construct() {
        parent::__construct('students');
    }

    public function findByName($name) {
        $response = $this->db->prepare("SELECT * FROM students WHERE name LIKE ?");
        $response->execute(["%$name%"]);
        return $response->fetchAll(PDO::FETCH_OBJ);
    }

    public function getStudentsBySection($sectionId) {
        $response = $this->db->prepare("SELECT * FROM students WHERE section = ?");
        $response->execute([$sectionId]);
        return $response->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>