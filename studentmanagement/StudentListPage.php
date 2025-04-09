<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>PDO Etudiant!</title>
    </head>

    <body>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
        <?php include_once("navbarfixed.php");?>
        


        <!-- As a heading -->
        <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Liste Des Etudiants</span>
        </div>
        </nav>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">image<i class="fa-solid fa-sort"></i></th>
                    <th scope="col">name<i class="fa-solid fa-sort"></i></th>
                    <th scope="col">birthday<i class="fa-solid fa-sort"></i></th>
                    <th scope="col">section<i class="fa-solid fa-sort"></i></th>
                    <th scope="col">actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once("etudiantsql.php");
                    foreach($students as $student){
                        echo'
                            <tr>
                                <th scope="row">'. $student['id'].'</th>
                                <th scope="row">'. $student['image'].'</th>
                                <th scope="row">'. $student['name'].'</th>
                                <td>'.$student['date_naissance'].'</td>
                                <td>'.$student['section'].'</td>
                            </tr>
                        ';
                    }

                ?>
            </tbody>
        </table>
    </body>