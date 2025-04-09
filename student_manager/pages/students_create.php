<?php
include '../includes/header.php';
if ($_SESSION['role'] != 'admin') {
    header("Location: students_list.php");
    exit();
}
require_once '../classes/Student.php';
require_once '../classes/Section.php';

$student = new Student();
$section = new Section();
$sections = $section->findAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name'],
        'birthday' => $_POST['birthday'],
        'section' => $_POST['section'],
        'image' => '' 
    ];

    if ($student->create($data)) {
        echo '<div class="alert alert-success">Student created successfully!</div>';
    } else {
        echo '<div class="alert alert-danger">Error creating student.</div>';
    }
}
?>

<h2>Ajouter un étudiant</h2>
<form method="post">
    <div class="mb-3">
        <label class="form-label">Nom</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Date de naissance</label>
        <input type="date" name="birthday" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Image (URL)</label>
        <input type="text" name="image" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Section</label>
        <select class="form-select" id="section" name="section" required>
            <?php foreach ($sections as $s): ?>
                <option value="<?=$s->id ?>"><?= $s->designation?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Ajouter</button>
    <a href="students_list.php" class="btn btn-secondary">Cancel</a>
</form>

<?php include_once '../includes/footer.php'; ?>