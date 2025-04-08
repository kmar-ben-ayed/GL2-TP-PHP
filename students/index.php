<?php
include_once 'classes/StudentRepository.php';
$pageTitle = "index";
include_once 'fragments/header.php';
$repo = new StudentRepository();
$students = $repo->findAll();

?>

<table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">birthday</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($students as $student): ?>
                            <tr>
                                <th scope="row"> <?= $student->id?> </th>
                                <td> <?= $student->nom?></td>
                                <td> <?= $student->date_de_naissance?> </td>
                                <td>
                                    <a href="detailsStudents.php?id=<?= $student->id ?>">Détails</a>
                                </td>

                            </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</body>
</html>