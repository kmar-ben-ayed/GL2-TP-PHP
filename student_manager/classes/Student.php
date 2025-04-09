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


    public function countFiltered($search = '') {
        $db = Database::getInstance();
        if ($search) {
            $stmt = $db->prepare("SELECT COUNT(*) FROM students WHERE name LIKE ?");
            $stmt->execute(["%$search%"]);
        } else {
            $stmt = $db->query("SELECT COUNT(*) FROM students");
        }
        return $stmt->fetchColumn();
    }

    public function paginate($search = '', $limit = 1, $offset = 0) {
        $db = Database::getInstance();
        if ($search) {
            $stmt = $db->prepare("SELECT * FROM students WHERE name LIKE ? LIMIT ? OFFSET ?");
            $stmt->bindValue(1, "%$search%", PDO::PARAM_STR);  // Recherche par nom (chaîne)
            $stmt->bindValue(2, $limit, PDO::PARAM_INT);       // Limite (entier)
            $stmt->bindValue(3, $offset, PDO::PARAM_INT);      // Offset (entier)
            $stmt->execute();
        } else {
            $stmt = $db->prepare("SELECT * FROM students LIMIT ? OFFSET ?");
            $stmt->bindValue(1, $limit, PDO::PARAM_INT);       // Limite (entier)
            $stmt->bindValue(2, $offset, PDO::PARAM_INT);      // Offset (entier)
            $stmt->execute();
        }
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
?>