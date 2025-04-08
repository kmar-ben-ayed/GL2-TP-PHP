<?php
require_once("connexionBD.php");
$_bdd=ConnexionBD::getInstance();
$_bdd->query("drop table if exists student;");

$req='CREATE TABLE student(
    id INT NOT NULL PRIMARY KEY,
    name VARCHAR(20) NOT NULL,
    date_naissance DATE NOT NULL,
    section VARCHAR(50));
    ';
$_bdd->query($req);
$req='INSERT INTO student values(1,"aymen","1982-02-07","GL"),(2,"skander","2018-07-11","RT");';
$_bdd->query($req);

?>