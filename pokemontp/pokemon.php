<?php
    include_once('attackpokemon.php');
    class Pokemon{
        private string $name;
        private string $url;
        protected int $hp;
        protected AttackPokemon $attack;
        public function __construct($name,$url,$hp,$attackMinimal,$attackMaximal,$specialAttack,$probabiliteSpecialAttack){
            $this->attack=new AttackPokemon($attackMinimal,$attackMaximal,$specialAttack,$probabiliteSpecialAttack);
            $this->name=$name;
            $this->url=$url;
            $this->hp=$hp;

        }
        public function getName(){
            return $this->name;
        }
        public function getUrl(){
            return $this->url;
        }
        public function getHp(){
            return $this->hp;
        }
        public function getAttackMaximal(){
            return $this->attack->getAttackMaximal();
        }
        public function getAttackMinimal(){
            return $this->attack->getAttackMinimal();
        }
        public function getSpecialAttack(){
            return $this->attack->getSpecialAttack();
        }
        public function getProbabiliteSpecialAttack(){
            return $this->attack->getProbabiliteSpecialAttack();
        }
        public function setName($name){
            $this->name=$name;
        }
        public function setUrl($url){
            $this->url=$url;
        }
        public function setHp($hp){
            $this->hp=$hp;
        }
        public function setAttackMaximal($attackMaximal){
            $this->attack->setAttackMaximal($attackMaximal);
        }
        public function setAttackMinimal($attackMinimal){
            $this->attack->setAttackMinimal($attackMinimal);
        }
        public function setSpecialAttack($specialAttack){
            $this->attack->setSpecialAttack($specialAttack);
        }
        public function setProbabiliteSpecialAttack($probabiliteSpecialAttack){
            $this->attack->setProbabiliteSpecialAttack($probabiliteSpecialAttack);
        }
        public function isDead(){
            if($this->hp<=0){
                return true;
            }else{
                return false;
            }
        }
        public function attack($P){
            $attakPoints=rand($this->getAttackMinimal(),$this->getAttackMaximal());
            $probaspecial=rand(0,100);
            if($probaspecial>=$this->getProbabiliteSpecialAttack()){
                $attakPoints=$attakPoints*$this->getSpecialAttack();
                $P->setHp($P->getHp() - $attakPoints);
            }else{
                $P->setHp($P->getHp() - $attakPoints);
            }
            return $attakPoints;
        }
        public function whoAmI(){
            return'
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action list-group-item-light">
                        <div class="imgettexte">
                        <p class="texte">'.$this->getName().'</p>
                            <img src="'.$this->getUrl().'" alt="Pokemon" class="rounded float-end" width="200" height="200">
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">Points :'.$this->getHp().'</a>
                    <a href="#" class="list-group-item list-group-item-action">Min Attack Points :'.$this->getAttackMinimal().'</a>
                    <a href="#" class="list-group-item list-group-item-action">Max Attack Points :'.$this->getAttackMaximal().'</a>
                    <a href="#" class="list-group-item list-group-item-action">Special Attack :'.$this->getSpecialAttack().'</a>
                    <a href="#" class="list-group-item list-group-item-action">Probability Special Attack :'.$this->getProbabiliteSpecialAttack().'</a>
                </div>
            ';
        }
    }
?>