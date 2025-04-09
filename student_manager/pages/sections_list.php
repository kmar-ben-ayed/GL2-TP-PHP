<?php
include_once '../includes/header.php';
include_once '../includes/navbar.php';
include_once '../classes/Section.php';
include_once '../classes/Student.php';

$section = new Section();
$student = new Student();
$sections = $section->findAll();
$role = $_SESSION['role'];

$searchName = isset($_GET['search']) ? trim($_GET['search']) : '';
if ($searchName) {
    $sections = $section->findByDesignation($searchName); 
} else {
    $sections = $section->findAll();
}

if ($role === 'admin' && isset($_GET['delete'])) {
    $section->delete($_GET['delete']);
    header('Location: sections_list.php');
    exit();
}

?>
<h2>Sections List</h2>

<form method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" 
               placeholder="Search by name" value="<?= $searchName ?>">
        <button type="submit" class="btn btn-primary">Search</button>
        <?php if ($searchName): ?>
            <a href="sections_list.php" class="btn btn-secondary">Clear</a>
        <?php endif; ?>
    </div>
</form>

<?php if ($role === 'admin'): ?>
    <a href="section_create.php" class="btn btn-success mb-3">Create New Section</a>
<?php endif; ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>designation</th>
            <th>description</th>
            <?php if ($role === 'admin'): ?>
                <th>Actions</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sections as $s): ?>
            <tr>
                <td><?= $s->id ?></td>
                <td><?= $s->designation ?></td>
                <td><?= $s->description ?></td>
                <?php if ($role === 'admin'): ?>
                    <td>
                        <a href="students_by_section.php?id=<?= $s->id ?>" class="btn btn-info btn-sm">Students</a>
                        <a href="section_update.php?id=<?= $s->id ?>" class="btn btn-warning btn-sm">Update</a>
                        <a href="?delete=<?= $s->id ?>" class="btn btn-danger btn-sm">Delete</a>
                        
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include_once '../includes/footer.php'; ?>