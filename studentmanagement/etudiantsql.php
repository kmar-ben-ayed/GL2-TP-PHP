<?php
include_once("navbarfixed.php");
require_once("connexionBD.php");
$_bdd=ConnexionBD::getInstance();
$_bdd->query("drop table if exists student;");

$req='CREATE TABLE IF NOT EXISTS student(
    id INT NOT NULL PRIMARY KEY,
    image VARCHAR(1000) NOT NULL,
    name VARCHAR(20) NOT NULL,
    date_naissance DATE NOT NULL,
    section VARCHAR(20) NOT NULL);
    ';
$_bdd->query($req);
$req='INSERT INTO student values(1,"https://unsplash.com/fr/photos/photographie-a-mise-au-point-peu-profonde-dune-femme-en-plein-air-pendant-la-journee-rDEOVtE7vOs","skander","2018-07-11","gl2");';
$_bdd->query($req);
$req='SELECT * FROM student;';
$rep=$_bdd->query($req);
$students=$rep->fetchAll(PDO::FETCH_ASSOC);

?>