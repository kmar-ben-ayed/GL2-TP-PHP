<?php
include_once '../includes/header.php';
include_once '../classes/Section.php';
if ($_SESSION['role'] != 'admin') {
    header("Location: sections_list.php");
    exit();
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: sections_list.php');
    exit;
}

$section = new Section();

$sectionId = $_GET['id'];
$sectionData = $section->findById($sectionId);

if (!$sectionData) {
    echo "<div class='alert alert-danger'>Section not found!</div>";
    include_once '../includes/footer.php';
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'designation' => $_POST['designation'],
        'description' => $_POST['description'],
    ];

    if ($section->update($sectionId, $data)) {
        echo '<div class="alert alert-success">Section updated successfully!</div>';
        $sectionData = $section->findById($sectionId); 
    } else {
        echo '<div class="alert alert-danger">Error updating section.</div>';
    }
}
?>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2>Update Section</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="designation" class="form-label">designation</label>
                <input type="text" class="form-control" id="designation" name="designation" 
                       value="<?=$sectionData['designation'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">description</label>
                <input type="text" class="form-control" id="description" name="description" 
                       value="<?=$sectionData['description'] ?>" required>
            </div>
           
            <button type="submit" class="btn btn-primary">Update Section</button>
            <a href="sections_list.php" class="btn btn-secondary">Cancel</a>

        </form>
    </div>
</div>

<?php include_once '../includes/footer.php'; ?>