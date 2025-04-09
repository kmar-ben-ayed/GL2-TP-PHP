<?php
include_once "../includes/header.php";
include_once "../includes/navbar.php";
include_once "../classes/Student.php";
include_once "../classes/Section.php";

$student = new Student();
$students = $student->findAll();
$role = $_SESSION['role'];

$perPage = 2;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $perPage;

$searchName = isset($_GET['search']) ? trim($_GET['search']) : '';
if ($searchName) {
    $students = $student->findByName($searchName); 
} else {
    $students = $student->findAll();
}

$total = $student->countFiltered($searchName);
$students = $student->paginate($searchName, $perPage, $offset);

if ($role === 'admin' && isset($_GET['delete'])) {
    $student->delete($_GET['delete']);
    header('Location: students_list.php');
    exit();
}


?>
<h2>Liste des Etudiants</h2>
<div class="search_container">
    <form method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" 
                placeholder="Veuillez renseigner votre nom" value="<?= htmlspecialchars($searchName) ?>">
            <button type="submit" class="btn btn-primary" style="background-color:red; border-color:red;">Filtrer</button>
            <?php if ($searchName): ?>
                <a href="students_list.php" class="btn btn-secondary">Supprimer</a>
            <?php endif; ?>
        </div>
    </form>

    <?php if ($role === 'admin'): ?>
        <a href="students_create.php" class="btn btn-success mb-3"><i class="fa-solid fa-user-plus"></i></a>
    <?php endif; ?>
</div>

<div class="mb-3 p-2">
            <button class="btn btn-secondary" style="background-color:gray;"><i class="fas fa-copy"></i> Copy</button>
            <button class="btn btn-secondary" style="background-color:gray;"><i class="fas fa-file-excel"></i> Excel</button>
            <button class="btn btn-secondary" style="background-color:gray;"><i class="fas fa-file-csv"></i> CSV</button>
            <button class="btn btn-secondary" style="background-color:gray;"><i class="fas fa-file-pdf"></i> PDF</button>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Birthday</th>
            <th>Section</th>
            <?php if ($role === 'admin'): ?>
                <th>Actions</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($students as $s): 
            $new_section = new Section();
            $section = $new_section->findById($s->section);
        ?>
            <tr>
                <td><?= $s -> id ?></td>
                <td><img src="../includes/<?= $s->image ?>" class="rounded-circle" width="50" height="50"></td>
                <td><?= $s-> name?></td>
                <td><?= $s->birthday ?></td>
                <td><?=$section['designation'] ?></td>
                <?php if ($role === 'admin'): ?>
                    <td>
                        <a href="student_detail.php?id=<?= $s->id ?>" class="btn btn-info btn-sm"><i class="fa-solid fa-circle-info"></i></a>
                        <a href="student_update.php?id=<?= $s->id ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="?delete=<?= $s->id ?>" class="btn btn-danger btn-sm"><i class="fa-solid fa-eraser"></i></a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
$totalPages = ceil($total / $perPage);

$prevPage = $page > 1 ? $page - 1 : 1;
$nextPage = $page < $totalPages ? $page + 1 : $totalPages;
?>


<div class="pagination_container">
    <p>
        showing <?= $page ?> to <?= $totalPages ?> to <?= $perPage ?> entries.
    </p>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            <li class="page-item <?= ($page == 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page - 1 ?>&search=<?= htmlspecialchars($searchName) ?>">Previous</a>
            </li>
            
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>&search=<?= htmlspecialchars($searchName) ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <li class="page-item <?= ($page == $totalPages) ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page + 1 ?>&search=<?= htmlspecialchars($searchName) ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>

<?php include_once '../includes/footer.php'; ?>
