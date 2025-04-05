<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="styleindex.css">
        <title>Pokemon Game!</title>
    </head>

    <body>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
        <div class="alert alert-info" role="alert">
            Les Combatteurs:
        </div>

        <?php
        include_once 'pokemon.php'; 
        require_once("PokemonFeu.php");
        require_once("PokemonEau.php");
        require_once("PokemonPlante.php");
        $P1=new PokemonFeu("Dracaufeu Gigamax","https://www.pokepedia.fr/images/8/8b/Dracaufeu_%28Gigamax%29-EB.png?20191016133231",200,10,100,2,20);
        $P2=new PokemonEau("salarsen gigamax","https://www.pokepedia.fr/images/thumb/1/16/Salarsen_%28Gigamax%29-EB.png/966px-Salarsen_%28Gigamax%29-EB.png?20200205143508",200,30,80,4,20);
        $roundNb=1;

        while(!$P1->isDead() && !$P2->isDead()){
            echo'
                <div class="PokemonsContainer">'.
                    $P1->whoAmI().
                    $P2->whoAmI().
                '</div>
            ';
            $P1_atk=$P1->attack($P2);
            $P2_atk=$P2->attack($P1);
            echo'
                <div class="alert alert-danger" role="alert">
                    Round'.$roundNb.':<br>
                    <div class="alert alert-light PointsContainer" role="alert">
                        <p class="points">'.$P1_atk.'</p>
                        <p class="points">'.$P2_atk.'</p>
                    </div>
                </div>
            ';
            $roundNb++;
        }
        
        if(!$P1->isDead() || !$P2->isDead()){
            echo'
                <div class="PokemonsContainer">'.
                    $P1->whoAmI().
                    $P2->whoAmI().
                '</div>
            ';
            $urlWinner=($P1->getHp()>=$P2->getHp())?$P1->getUrl():$P2->getUrl();
            echo'
            <div class="alert alert-success" role="alert">
                <div class="imgettexte">
                    <p class="texte">Le vainqueur est: </p>
                    <img src="'.$urlWinner.'" alt="Pokemon" class="rounded float-end" width="200" height="200">
                </div>
            </div>
            ';
            $roundNb=1;
        }
        ?>
    </body>
</html>