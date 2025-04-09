<?php
include_once '../includes/header.php';
if ($_SESSION['role'] != 'admin') {
    header("Location: sections_list.php");
    exit();
}
include_once '../classes/Section.php';

$section = new Section();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'designation' => $_POST['designation'],
        'description' => $_POST['description']
    ];

    if ($section->create($data)) {
        echo '<div class="alert alert-success">Section created successfully!</div>';
    } else {
        echo '<div class="alert alert-danger">Error creating section.</div>';
    }
}
?>

<h2>Ajouter une section</h2>
<form method="post">
    <div class="mb-3">
        <label class="form-label">designation</label>
        <input type="text" name="designation" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">description</label>
        <input type="text" name="description" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Ajouter</button>
    <a href="sections_list.php" class="btn btn-secondary">Cancel</a>
</form>

<?php include_once '../includes/footer.php'; ?>