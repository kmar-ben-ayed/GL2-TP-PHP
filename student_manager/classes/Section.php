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
}
?>