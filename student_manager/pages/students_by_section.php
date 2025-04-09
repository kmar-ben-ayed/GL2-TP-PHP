<?php
include_once "../includes/header.php";
include_once '../includes/navbar.php';
include_once "../classes/Student.php";
include_once "../classes/Section.php";

if ($_SESSION['role'] !== 'admin') {
    header('Location: sections_list.php');
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: sections_list.php');
    exit;
}

$sectionId = $_GET['id'];

if ($_SESSION['role'] === 'admin' && isset($_GET['delete'])) {
    $student = new Student();
    $student->delete($_GET['delete']);
    header("Location: students_list.php"); 
}

$student = new Student();
$section = new Section();



$sectionData = $section->findById($sectionId);
if (!$sectionData) {
    echo "<div class='alert alert-danger'>Section not found!</div>";
    include_once '../includes/footer.php';
    exit;
}

$studentData = $student->getStudentsBySection($sectionId);

if (!$studentData) {
    echo "<div class='alert alert-danger'>No student in this section!</div>";?>
    <a href="sections_list.php" class="btn btn-secondary">Back To Sections List</a>
    <?php
    include_once '../includes/footer.php';
    exit;
}
?>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2>Students in <?=$sectionData['designation'] ?></h2>
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Birthday</th>
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <th>Actions</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($studentData as $s): ?>
                        <tr>
                            <td><?=$s['id'] ?></td>
                            <td><?=$s['name']?></td>
                            <td><?=$s['birthday'] ?></td>
                            <?php if ($_SESSION['role'] === 'admin'): ?>
                                <td>
                                    <a href="student_detail.php?id=<?= $s['id'] ?>" class="btn btn-info btn-sm"><i class="fa-solid fa-circle-info"></i></a>
                                    <a href="student_update.php?id=<?= $s['id'] ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="?id=<?= $sectionId ?>&delete=<?= $s['id'] ?>" class="btn btn-danger btn-sm"><i class="fa-solid fa-eraser"></i></a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="sections_list.php?>" class="btn btn-secondary btn-sm">Back to Sections List</a>

    </div>
</div>

<?php include_once '../includes/footer.php'; ?>