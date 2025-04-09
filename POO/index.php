<?php
require_once 'Pokemon.php';
require_once 'AttackPokemon.php';
require_once 'PokemonFeu.php';
require_once 'PokemonEau.php';
require_once 'PokemonPlante.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Combat des Pokemons</title>
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
            padding: 20px;
            margin-bottom: 30px;
            border-bottom: 1px solid #999;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            text-align: center;
        }

        .menu {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .menu h2 {
            color: #333;
            margin-top: 0;
        }

        .menu-item {
            margin: 15px 0;
        }

        .menu-item a {
            display: inline-block;
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }

        .menu-item a:hover {
            background-color: #45a049;
        }

        .description {
            margin-top: 30px;
            padding: 20px;
            background-color: #e0ffff;
            border-radius: 5px;
            text-align: left;
            border: 1px solid #add8e6;
        }

        .description h2 {
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .description p {
            line-height: 1.6;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Combat des Pokemons</h1>
    </div>
    <div class="container">
        <div class="menu">
            <h2>Menu Principal</h2>
            <div class="menu-item">
                <a href="combat.php">Lancer un Combat</a>
            </div>
            <div class="menu-item">
                <a href="combat.php?customPokemon=1">Creer votre Pokemon personnalisé</a>
            </div>
        </div>

        <div class="description">
            <h2>Bienvenue dans le combat des Pokemons</h2>

            <p>
                Il y a plusieurs types de Pokémon (Feu, Eau, Plante) qui ont des avantages et des faiblesses les uns contre les autres:
            </p>
            <ul>
                <li>Les Pokémon de type Feu sont efficaces contre les Pokémon de type Plante (2x dégâts) mais faibles contre Eau et Feu (0.5x dégâts)</li>
                <li>Les Pokémon de type Eau sont efficaces contre les Pokémon de type Feu (2x dégâts) mais faibles contre Eau et Plante (0.5x dégâts)</li>
                <li>Les Pokémon de type Plante sont efficaces contre les Pokémon de type Eau (2x dégâts) mais faibles contre Plante et Feu (0.5x dégâts)</li>
            </ul>
            <p>
                Chaque Pokémon possède des caractéristiques d'attaque (minimale, maximale) et peut réaliser des attaques spéciales avec une certaine probabilité.
            </p>
        </div>
    </div>
</body>

</html>