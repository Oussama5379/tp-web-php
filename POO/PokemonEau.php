<?php
require_once 'Pokemon.php';
require_once 'PokemonFeu.php';
require_once 'PokemonPlante.php';

class PokemonEau extends Pokemon
{
    public function attack(Pokemon $p)
    {
        $attackPoints = parent::attack($p);

        if ($p instanceof PokemonFeu) {
            $attackPoints *= 2;
            $p->setHp($p->getHp() - $attackPoints);
            return $attackPoints * 2;
        } elseif ($p instanceof PokemonEau || $p instanceof PokemonPlante) {
            $p->setHp($p->getHp() + $attackPoints / 2);
            return $attackPoints * 0.5;
        }

        return $attackPoints;
    }
}
