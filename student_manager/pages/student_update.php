<?php
include_once '../includes/header.php';
include_once '../classes/Student.php';
include_once '../classes/Section.php';
if ($_SESSION['role'] != 'admin') {
    header("Location: students_list.php");
    exit();
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: students_list.php');
    exit;
}

$student = new Student();
$section = new Section();

$studentId = $_GET['id'];
$studentData = $student->findById($studentId);
$sections = $section->findAll();

if (!$studentData) {
    echo "<div class='alert alert-danger'>Student not found!</div>";
    include_once '../includes/footer.php';
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name'],
        'birthday' => $_POST['birthday'],
        'section' => $_POST['section'],
        'image' => $_POST['image']
    ];

    if ($student->update($studentId, $data)) {
        echo '<div class="alert alert-success">Student updated successfully!</div>';
        $studentData = $student->findById($studentId); 

    } else {
        echo '<div class="alert alert-danger">Error updating student.</div>';
    }
}
?>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2>Update Student</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" 
                       value="<?=$studentData['name'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="birthday" class="form-label">Birthday</label>
                <input type="date" class="form-control" id="birthday" name="birthday" 
                       value="<?=$studentData['birthday'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="text" class="form-control" id="image" name="image" 
                       value="<?=$studentData['image'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="section" class="form-label">Section</label>
                <select class="form-select" id="section" name="section" required>
                    <?php foreach ($sections as $s): ?>
                        <option value="<?=$s->id; ?>" 
                                <?=$s->id == $studentData['section'] ? 'selected' : ''; ?>>
                            <?=$s->designation ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Student</button>
            <a href="students_list.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php include_once '../includes/footer.php'; ?>