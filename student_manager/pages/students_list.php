<?php
include_once "../includes/header.php";
include_once "../includes/navbar.php";
include_once "../classes/Student.php";

$student = new Student();
$students = $student->findAll();
$role = $_SESSION['role'];

$searchName = isset($_GET['search']) ? trim($_GET['search']) : '';
if ($searchName) {
    $students = $student->findByName($searchName); 
} else {
    $students = $student->findAll();
}


if ($role === 'admin' && isset($_GET['delete'])) {
    $student->delete($_GET['delete']);
    header('Location: students_list.php');
    exit();
}


?>
<h2>Students List</h2>

<form method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" 
               placeholder="Search by name" value="<?= htmlspecialchars($searchName) ?>">
        <button type="submit" class="btn btn-primary">Search</button>
        <?php if ($searchName): ?>
            <a href="students_list.php" class="btn btn-secondary">Clear</a>
        <?php endif; ?>
    </div>
</form>

<?php if ($role === 'admin'): ?>
    <a href="students_create.php" class="btn btn-success mb-3">Create New Student</a>
<?php endif; ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Birthday</th>
            <th>Section</th>
            <?php if ($role === 'admin'): ?>
                <th>Actions</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($students as $s): ?>
            <tr>
                <td><?= $s -> id ?></td>
                <td><?= $s-> name?></td>
                <td><?= $s->birthday ?></td>
                <td><?= $s->section ?></td>
                <?php if ($role === 'admin'): ?>
                    <td>
                        <a href="student_detail.php?id=<?= $s->id ?>" class="btn btn-info btn-sm">Details</a>
                        <a href="student_update.php?id=<?= $s->id ?>" class="btn btn-warning btn-sm">Update</a>
                        <a href="?delete=<?= $s->id ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include_once '../includes/footer.php'; ?>
