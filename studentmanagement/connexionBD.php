<?php
class ConnexionBD{
    private static $_dbname = "bdetudiant";
    private static $_user = "root";
    private static $_pwd = "kmayrakammou2004";
    private static $_host = "localhost";
    private static $_bdd = null;
    private function __construct()
    {
        try {
            self :: $_bdd = new PDO("mysql:host=". self::$_host. ";charset=utf8", 
                                self::$_user, 
                                self::$_pwd
                            );
            self :: $_bdd -> setAttribute(PDO :: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
            
            self::$_bdd->exec("CREATE DATABASE IF NOT EXISTS " . self::$_dbname);
            
            self :: $_bdd = new PDO("mysql:host=". self::$_host. ";dbname=". self::$_dbname. ";charset=utf8", 
                                self::$_user, 
                                self::$_pwd,
                                array(PDO :: MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8')
                            );
            self :: $_bdd -> setAttribute(PDO :: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
        
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    public static function getInstance()
    {
        if(self :: $_bdd  === null) {
            new ConnexionBD();
        }
        return (self :: $_bdd);
    }
}
?>