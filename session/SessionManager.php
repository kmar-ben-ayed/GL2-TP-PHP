<?php
    class SessionManager {
        public function __construct(){
            session_start();
        }

        public function getVisitCount(): int{
            if (!isset($_SESSION['nbre'])) {
                $_SESSION['nbre'] = 0;
            }
            return $_SESSION['nbre'];
            
        }

        public function incrementVisitCount(): void{
            if (!isset($_SESSION['nbre'])) {
                $_SESSION['nbre'] = 1;
            }
            else{
                $_SESSION['nbre']++;
            }
        }

        public function reset(): void{
            session_unset();
            session_destroy();
            header("Location: index.php");
        }

    }