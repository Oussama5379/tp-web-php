<?php
require_once 'Pokemon.php';
require_once 'AttackPokemon.php';
require_once 'PokemonFeu.php';
require_once 'PokemonEau.php';
require_once 'PokemonPlante.php';

session_start();


if (isset($_GET['customPokemon'])) {
    header('Location: custom.php');
    exit;
}


if (!isset($_SESSION['round']) || isset($_GET['reset'])) {
    $_SESSION['round'] = 1;

    $attackDracaufeuGigamax = new AttackPokemon(10, 100, 2, 20);
    $attackTortankGigamax = new AttackPokemon(30, 80, 4, 20);

    $pokemon1 = new PokemonFeu("Dracaufeu Gigamax", "images/dracaufeu.png", 200, $attackDracaufeuGigamax);
    $pokemon2 = new PokemonEau("Tortank Gigamax", "images/tortank.png", 200, $attackTortankGigamax);

    $_SESSION['pokemon1'] = serialize($pokemon1);
    $_SESSION['pokemon2'] = serialize($pokemon2);
    $_SESSION['lastAttack'] = null;
    $_SESSION['winner'] = null;
}

$pokemon1 = unserialize($_SESSION['pokemon1']);
$pokemon2 = unserialize($_SESSION['pokemon2']);

//le deroulement d'une round
if (isset($_GET['next_round']) && !$pokemon1->isDead() && !$pokemon2->isDead()) {
    
    $damagePoints1 = $pokemon1->attack($pokemon2);

    
    $damagePoints2 = 0;
    if (!$pokemon2->isDead()) {
        
        $damagePoints2 = $pokemon2->attack($pokemon1);
    }

    $_SESSION['lastAttack'] = [
        'damage1' => $damagePoints1,
        'damage2' => $damagePoints2
    ];

    $_SESSION['pokemon1'] =serialize($pokemon1);
    $_SESSION['pokemon2'] =  serialize($pokemon2);

    $_SESSION['round']++;

    if ($pokemon1->isDead() || $pokemon2->isDead()) {
        $_SESSION['winner'] = $pokemon1->isDead() ? 2 : 1;
    }

    header('Location: combat.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
        <title>Combat des pokemons</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .header {
            background-color: #b0c4de;
            color: #333;
            text-align: center;
            padding: 10px;
            margin-bottom: 20px;
            border-bottom: 1px solid #999;
        }

        .container {
            width: 90%;
            margin: 0 auto;
        }

        .combattants {
            background-color: #e0ffff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #add8e6;
        }

        .combat-zone {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .pokemon-info {
            width: 48%;
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }

        .pokemon-name {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .pokemon-img img {
            max-width: 100px;
            height: auto;
        }

        .pokemon-stats {
            margin-top: 10px;
            font-size: 14px;
        }

        .round {
            background-color: #ffe4e1;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            border: 1px solid #ffb6c1;
        }

        .result {
            background-color: #e0eee0;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
            border: 1px solid #98fb98;
        }

        .controls {
            text-align: center;
            margin-top: 20px;
        }

        .controls button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 0 10px;
        }

        .controls button:hover {
            background-color: #45a049;
        }

        .navigation {
            text-align: center;
            margin-top: 20px;
        }

        .navigation a {
            color: #333;
            text-decoration: none;
            margin: 0 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Combat des pokemons</h1>
    </div>
    <div class="container">
        <div class="combattants">
            <h2>Les combattants</h2>
            <div class="combat-zone">
                <?php $pokemon1->whoAmI(); ?>
                <?php $pokemon2->whoAmI(); ?>
            </div>
        </div>

        <?php if (isset($_SESSION['lastAttack'])): ?>
            <div class="round">
                <h3>Round <?= $_SESSION['round'] - 1 ?></h3>
                <p>
                    <?= $pokemon1->getName() ?> a infligé <?= $_SESSION['lastAttack']['damage1'] ?> points de degat a <?= $pokemon2->getName() ?><br>
                    <?php if ($_SESSION['lastAttack']['damage2'] > 0): ?>
                        <?= $pokemon2->getName() ?> a  infligé <?= $_SESSION['lastAttack']['damage2'] ?> points de degats a  <?= $pokemon1->getName() ?>
                    <?php else: ?>
                        <?= $pokemon2->getName() ?> n'a pas pu attaquer
                    <?php endif; ?>
                </p>
            </div>
        <?php endif; ?>

        <div class="combat-zone">
            <div class="pokemon-info">
                <div class="pokemon-name"><?= $pokemon1->getName() ?>
            </div>
                <div class="pokemon-img"><img src="<?= $pokemon1->getUrl() ?>" alt="<?= $pokemon1->getName() ?>" />
            </div>
                <div class="pokemon-stats">
                    Points : <?= $pokemon1->getHp() ?>
                </div>
            </div>
            <div class="pokemon-info">
                <div class="pokemon-name"><?= $pokemon2->getName() ?>
            </div>
                <div class="pokemon-img"><img src="<?= $pokemon2->getUrl() ?>" alt="<?= $pokemon2->getName() ?>" />
            </div>
                <div class="pokemon-stats">
                    Points : <?= $pokemon2->getHp() ?>
                </div>
            </div>
        </div>

        <?php if (isset($_SESSION['winner'])): ?>
            <div class="result">
                <h3>Le vainqueur est:</h3>
                <div class="pokemon-img">
                    <img src="<?= $_SESSION['winner'] == 1 ? $pokemon1->getUrl() : $pokemon2->getUrl() ?>"
                        alt="<?= $_SESSION['winner'] == 1 ? $pokemon1->getName() : $pokemon2->getName() ?>" />
                </div>
            </div>
        <?php else: ?>
            <div class="controls">
                <a href="combat.php?next_round=1"><button>Tour suivant</button></a>
            </div>
        <?php endif; ?>

        <div class="navigation">
            <a href="combat.php?reset=1">Recommencer le combat</a>
            <a href="custom.php">Crer des pokemonss personnalisés</a>
            <a href="index.php">Retour a l'accueil</a>
        </div>
    </div>
</body>

</html>