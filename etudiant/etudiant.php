<?php
    class etudiant {
        public function __construct(
            private $nom,
            private $notes
        )
        {}
        public function affichenotes(){
            foreach($this->notes as $note){
                if ($note<10){
                    $bgcolor="reddiv";
                }elseif($note==10){
                    $bgcolor="orangediv";
                }else{
                    $bgcolor="greendiv";
                }
                echo "<div class={$bgcolor}> {$note} </div>";
            }
        }
        public function calculmoy(){
            $s=0;
            foreach($this->notes as $note){
                $s+=$note;
            }
            $s=$s/count($this->notes);
            return $s;
        }
        public function afficheres(){
            if($this->calculmoy()>=10){
                echo "l'étudiant {$this->nom} est admis avec une moyenne de {$this->calculmoy()} <br>";
            }else{ 
                echo "l'étudiant {$this->nom} est non admis avec une moyenne de {$this->calculmoy()} <br>";
            }
        }
        public function getNom(){
            return $this->nom;
        }
    }
?>