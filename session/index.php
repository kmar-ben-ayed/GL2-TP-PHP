<?php
    include 'SessionManager.php';
    $session = new SessionManager();
    $session->incrementVisitCount();
    $count = $session->getVisitCount();
    if(isset($_POST['reset'])){
        $session->reset();
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Session Manager</title>
</head>
<body>
    <div class="container">
        <?php 
            if ($count === 1){
        ?>
        <div class="alert alert-success">
            Bienvenu à notre plateforme
        </div>
        <?php
            }
            else{   
        ?>
        <div class="alert alert-success">
            Merci pour votre fidélité, c’est votre <?= $count ?> éme visite
        </div>
        <?php
            }
        ?>
        <form method="post" style="text-align: center">
            <button name="reset" type="submit" class="btn btn-danger">reset</button>
        </form>
        
    </div>
    
</body>
</html>