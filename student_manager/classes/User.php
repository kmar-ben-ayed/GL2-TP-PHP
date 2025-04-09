<?php
include_once "Repository.php";
class User extends Repository {
    public function __construct() {
        parent::__construct('users');
    }

    public function authenticate($username, $password) {
        $response = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $response->execute([$username]);
        $user = $response->fetch(PDO::FETCH_ASSOC);
        if ($user && $user['password'] === $password) {
            return $user;
        }
    }
}
?>