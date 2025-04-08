<?php
$pageTitle = "student details";
include_once 'fragments/header.php';
include_once "classes/StudentRepository.php";
$db = ConnexionDB::getInstance();
$id = $_GET['id'];
$studentRepo = new StudentRepository();
$student = $studentRepo->findById($id);
if (!$student) {
    header('Location: index.php');
}
?>

<div class="container">
    <h2><?= $student["nom"]?></h2>
    <br>
    <p><?= $student["date_de_naissance"]?></p>
    <p><?= $student["section"]?></p>
            
</div>
    
</body>
</html>

