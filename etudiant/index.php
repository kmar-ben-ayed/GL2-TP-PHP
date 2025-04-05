
<?php
    include_once 'etudiant.php';
    $et1=new etudiant("Aymen",array(11,13,18,7,10,13,2,5,1));
    $moy1=$et1->calculmoy();

    $et2=new etudiant("Skander",array(15,9,8,16));
    $moy2=$et2->calculmoy();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>projet Etudiant</title>
    <link rel="stylesheet" href="styleetud.css">
</head>
<body>
    <div class="container">
        <div class="etudiant">
            <p class="nom"> <?php echo $et1->getNom(); ?></p>
            <?php $et1->affichenotes(); ?>
            <div class="moyenne">
                <p class="moy">votre moyenne est <?php echo $moy1; ?></p>
            </div>
        </div>   
        <div class="etudiant">
            <p class="nom"> <?php echo $et2->getNom(); ?></p>
            <?php $et2->affichenotes(); ?>
            <div class="moyenne">
                <p class="moy">votre moyenne est <?php echo $moy2; ?></p>
            </div>
        </div> 
    </div>
</body>
</html>
