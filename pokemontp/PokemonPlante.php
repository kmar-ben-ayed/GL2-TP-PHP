<?php
    class PokemonPlante extends Pokemon{
        public function attack($P){

            if(get_class($P)=="PokemonEau"){

                $attakPoints=(rand($this->getAttackMinimal(),$this->getAttackMaximal()));
                $probaspecial=rand(0,100);
                if($probaspecial>=$this->getProbabiliteSpecialAttack()){
                    $attakPoints=$attakPoints*$this->getSpecialAttack();
                    $P->setHp($P->getHp() - $attakPoints*2);
                }else{
                    $P->setHp($P->getHp() - $attakPoints*2);
                }
                return $attakPoints;
            }
            
            elseif(get_class($P)=="PokemonPlante" || get_class($P)=="PokemonFeu"){
                
                $attakPoints=(rand($this->getAttackMinimal(),$this->getAttackMaximal()));
                $probaspecial=rand(0,100);
                if($probaspecial>=$this->getProbabiliteSpecialAttack()){
                    $attakPoints=$attakPoints*$this->getSpecialAttack();
                    $P->setHp($P->getHp() - $attakPoints*0.5);
                }else{
                    $P->setHp($P->getHp() - $attakPoints*0.5);
                }
                return $attakPoints;
            }
            
            else{
                Parent::attack($P);
            }
        }
    }

?>