<?php
include_once 'Repository.php';

class Section extends Repository {
    public function __construct() {
        parent::__construct('sections');
    }

    public function findByDesignation($name) {
        $response = $this->db->prepare("SELECT * FROM sections WHERE designation LIKE ? ");
        $response->execute(["%$name%"]);
        return $response->fetchAll(PDO::FETCH_OBJ);
    }

    
    public function countFiltered($search = '') {
        $db = Database::getInstance();
        if ($search) {
            $stmt = $db->prepare("SELECT COUNT(*) FROM sections WHERE designation LIKE ?");
            $stmt->execute(["%$search%"]);
        } else {
            $stmt = $db->query("SELECT COUNT(*) FROM sections");
        }
        return $stmt->fetchColumn();
    }

    public function paginate($search = '', $limit = 1, $offset = 0) {
        $db = Database::getInstance();
        if ($search) {
            $stmt = $db->prepare("SELECT * FROM sections WHERE designation LIKE ? LIMIT ? OFFSET ?");
            $stmt->bindValue(1, "%$search%", PDO::PARAM_STR);  // Recherche par nom (chaîne)
            $stmt->bindValue(2, $limit, PDO::PARAM_INT);       // Limite (entier)
            $stmt->bindValue(3, $offset, PDO::PARAM_INT);      // Offset (entier)
            $stmt->execute();
        } else {
            $stmt = $db->prepare("SELECT * FROM sections LIMIT ? OFFSET ?");
            $stmt->bindValue(1, $limit, PDO::PARAM_INT);       // Limite (entier)
            $stmt->bindValue(2, $offset, PDO::PARAM_INT);      // Offset (entier)
            $stmt->execute();
        }
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
?>