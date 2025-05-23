<?php
include_once "../includes/header.php";
include_once "../includes/navbar.php";
include_once "../classes/Student.php";
include_once "../classes/Section.php";

if ($_SESSION['role'] !== 'admin') {
    header('Location: students.php');
    exit;
}

$student = new Student();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: students.php');
    exit;
}

$studentId = $_GET['id'];

$studentData = $student->findById($studentId);

if (!$studentData) {
    echo "<div class='alert alert-danger'>Student not found!</div>";
    include_once '../includes/footer.php';
    exit;
}

$new_section = new Section();
$section = $new_section->findById($studentData['section']);
?>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2>Student Details</h2>
        <div class="card">
            <div class="card-header">
                <h5><?php echo htmlspecialchars($studentData['name']); ?></h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <td><?php echo htmlspecialchars($studentData['id']); ?></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td><?php echo htmlspecialchars($studentData['name']); ?></td>
                    </tr>
                    <tr>
                        <th>Birthday</th>
                        <td><?php echo htmlspecialchars($studentData['birthday']); ?></td>
                    </tr>
                    <tr>
                        <th>Section</th>
                        <td><?php echo htmlspecialchars($section["designation"]); ?></td>
                    </tr>
                    <?php if (!empty($studentData['image'])): ?>
                        <tr>
                            <th>Image</th>
                            <td><img src="../includes/<?php echo $studentData['image']; ?>" class="rounded-circle" width="50" height="50"></td>
                        </tr>
                    <?php endif; ?>
                </table>
                <a href="students_list.php" class="btn btn-secondary">Back to Students List</a>
            </div>
        </div>
    </div>
</div>

<?php include_once '../includes/footer.php'; ?>