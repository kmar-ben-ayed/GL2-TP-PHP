<?php
    class AttackPokemon{
        private int $attackMinimal;
        private int $attackMaximal;
        private int $specialAttack;
        private int $probabiliteSpecialAttack;
        public function __construct(int $attackMinimal,int $attackMaximal,int $specialAttack,int $probabiliteSpecialAttack)
        {
            $this->attackMinimal=$attackMinimal;
            $this->attackMaximal=$attackMaximal;
            $this->specialAttack=$specialAttack;
            $this->probabiliteSpecialAttack=$probabiliteSpecialAttack;
        }
        public function getAttackMinimal(){
            return $this->attackMinimal;
        }
        public function getAttackMaximal(){
            return $this->attackMaximal;
        }
        public function getSpecialAttack(){
            return $this->specialAttack;
        }
        public function getProbabiliteSpecialAttack(){
            return $this->probabiliteSpecialAttack;
        }
        public function setAttackMinimal($attackMinimal){
            $this->attackMinimal=$attackMinimal;
        }
        public function setAttackMaximal($attackMaximal){
            $this->attackMaximal=$attackMaximal;
        }
        public function setSpecialAttack($specialAttack){
            $this->specialAttack=$specialAttack;
        }
        public function setProbabiliteSpecialAttack($probabiliteSpecialAttack){
            $this->probabiliteSpecialAttack=$probabiliteSpecialAttack;
        }
    }
?>