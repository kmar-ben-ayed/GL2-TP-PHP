<?php
include_once("navbarfixed.php");
require_once("connexionBD.php");
$_bdd=ConnexionBD::getInstance();
$_bdd->query("drop table if exists student;");

$req='CREATE TABLE IF NOT EXISTS student(
    id INT NOT NULL PRIMARY KEY,
    name VARCHAR(20) NOT NULL,
    date_naissance DATE NOT NULL);
    ';
$_bdd->query($req);
$req='INSERT INTO student values(1,"aymen","1982-02-07"),(2,"skander","2018-07-11");';
$_bdd->query($req);
$req='SELECT * FROM student;';
$rep=$_bdd->query($req);
$students=$rep->fetchAll(PDO::FETCH_ASSOC);

?>