<?php
require_once 'AttackPokemon.php';

class Pokemon
{
    protected $name;
    protected $url;
    protected $hp;
    protected $attackPokemon;

    public function __construct($name, $url, $hp, AttackPokemon $attackPokemon)
    {
        $this->name = $name;
        $this->url = $url;
        $this->hp = $hp;
        $this->attackPokemon = $attackPokemon;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getHp()
    {
        return $this->hp;
    }

    public function setHp($hp)
    {
        $this->hp = $hp;
    }

    public function getAttackPokemon()
    {
        return $this->attackPokemon;
    }

    public function isDead()
    {
        return $this->hp <= 0;
    }

    public function attack(Pokemon $p)
    {
        $attackPoints = rand(
            $this->attackPokemon->getAttackMinimal(),
            $this->attackPokemon->getAttackMaximal()
        );

// Vrification si attaque speciale
        $rand = rand(1, 100);
        if ($rand <= $this->attackPokemon->getProbabilitySpecialAttack()) {
            $attackPoints *= $this->attackPokemon->getSpecialAttack();
        }

        $p->setHp($p->getHp() - $attackPoints);

        return $attackPoints;
    }

    public function whoAmI()
    {
        echo "<div class='pokemon-info'>";
        echo "<div class='pokemon-name'>" . $this->name . "</div>";
        echo "<div class='pokemon-img'><img src='" . $this->url . "' alt='" . $this->name . "' /></div>";
        echo "<div class='pokemon-stats'>";
        echo "Points : " . $this->hp . "<br>";
        echo "Min Attack Points : " . $this->attackPokemon->getAttackMinimal() . "<br>";
        echo "Max Attack Points : " . $this->attackPokemon->getAttackMaximal() . "<br>";
        echo "Special Attack : " . $this->attackPokemon->getSpecialAttack() . "<br>";
        echo "Probability Special Attack : " . $this->attackPokemon->getProbabilitySpecialAttack();
        echo "</div>";
        echo "</div>";
    }
}
