<?php
require_once 'Pokemon.php';
require_once 'AttackPokemon.php';
require_once 'PokemonFeu.php';
require_once 'PokemonEau.php';
require_once 'PokemonPlante.php';

session_start();

if (isset($_POST['create'])) {

    $pokemon1 = null;
    $pokemon2 = null;

    $attack1 = new AttackPokemon(
        intval($_POST['minAttack1']),
        intval($_POST['maxAttack1']),
        intval($_POST['specialAttack1']),
        intval($_POST['probabilitySpecialAttack1'])
    );

    switch ($_POST['type1']) {
        case 'feu':
            $pokemon1 = new PokemonFeu($_POST['name1'], $_POST['url1'], intval($_POST['hp1']), $attack1);
            break;
        case 'eau':
            $pokemon1 = new PokemonEau($_POST['name1'], $_POST['url1'], intval($_POST['hp1']), $attack1);
            break;
        case 'plante':
            $pokemon1 = new PokemonPlante($_POST['name1'], $_POST['url1'], intval($_POST['hp1']), $attack1);
            break;
    }


    $attack2 = new AttackPokemon(
        intval($_POST['minAttack2']),
        intval($_POST['maxAttack2']),
        intval($_POST['specialAttack2']),
        intval($_POST['probabilitySpecialAttack2'])
    );

    switch ($_POST['type2']) {
        case 'feu':
            $pokemon2 = new PokemonFeu($_POST['name2'], $_POST['url2'], intval($_POST['hp2']), $attack2);
            break;
        case 'eau':
            $pokemon2 = new PokemonEau($_POST['name2'], $_POST['url2'], intval($_POST['hp2']), $attack2);
            break;
        case 'plante':
            $pokemon2 = new PokemonPlante($_POST['name2'], $_POST['url2'], intval($_POST['hp2']), $attack2);
            break;
    }


    $_SESSION['round'] = 1;
    $_SESSION['pokemon1'] = serialize($pokemon1);
    $_SESSION['pokemon2'] = serialize($pokemon2);
    $_SESSION['lastAttack'] = null;
    $_SESSION['winner'] = null;


    header('Location: combat.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Créer vos Pokémon</title>
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

        .form-container {
            display: flex;
            justify-content: space-between;
        }

        .pokemon-form {
            width: 48%;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .submit-container {
            text-align: center;
            margin-top: 20px;
        }

        .submit-btn {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #333;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Créer vos Pokémon pour le combat</h1>
    </div>
    <div class="container">
        <form method="post" action="custom.php">
            <div class="form-container">
                <div class="pokemon-form">
                    <h2>Pokemon 1</h2>
                    <div class="form-group">
                        <label for="name1">Nom:</label>
                        <input type="text" id="name1" name="name1" value="Dracaufeu Gigamax" required>
                    </div>
                    <div class="form-group">
                        <label for="url1">URL de l'image:</label>
                        <input type="text" id="url1" name="url1" value="images/dracaufeu.png" required>
                    </div>
                    <div class="form-group">
                        <label for="hp1">Points de vie:</label>
                        <input type="number" id="hp1" name="hp1" value="200" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="type1">Type:</label>
                        <select id="type1" name="type1" required>
                            <option value="feu" selected>Feu</option>
                            <option value="eau">Eau</option>
                            <option value="plante">Plante</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="minAttack1">Attaque minimale:</label>
                        <input type="number" id="minAttack1" name="minAttack1" value="10" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="maxAttack1">Attaque maximale:</label>
                        <input type="number" id="maxAttack1" name="maxAttack1" value="100" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="specialAttack1">Coefficient d'attaque spéciale:</label>
                        <input type="number" id="specialAttack1" name="specialAttack1" value="2" min="1" step="0.1" required>
                    </div>
                    <div class="form-group">
                        <label for="probabilitySpecialAttack1">Probabilité d'attaque spéciale (%):</label>
                        <input type="number" id="probabilitySpecialAttack1" name="probabilitySpecialAttack1" value="20" min="0" max="100" required>
                    </div>
                </div>

                <div class="pokemon-form">
                    <h2>Pokemon 2</h2>
                    <div class="form-group">
                        <label for="name2">Nom:</label>
                        <input type="text" id="name2" name="name2" value="Tortank Gigamax" required>
                    </div>
                    <div class="form-group">
                        <label for="url2">URL de l'image:</label>
                        <input type="text" id="url2" name="url2" value="images/tortank.png" required>
                    </div>
                    <div class="form-group">
                        <label for="hp2">Points de vie:</label>
                        <input type="number" id="hp2" name="hp2" value="200" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="type2">Type:</label>
                        <select id="type2" name="type2" required>
                            <option value="feu">Feu</option>
                            <option value="eau" selected>Eau</option>
                            <option value="plante">Plante</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="minAttack2">Attaque minimale:</label>
                        <input type="number" id="minAttack2" name="minAttack2" value="30" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="maxAttack2">Attaque maximale:</label>
                        <input type="number" id="maxAttack2" name="maxAttack2" value="80" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="specialAttack2">Coefficient d'attaque spéciale:</label>
                        <input type="number" id="specialAttack2" name="specialAttack2" value="4" min="1" step="0.1" required>
                    </div>
                    <div class="form-group">
                        <label for="probabilitySpecialAttack2">Probabilité d'attaque spéciale (%):</label>
                        <input type="number" id="probabilitySpecialAttack2" name="probabilitySpecialAttack2" value="20" min="0" max="100" required>
                    </div>
                </div>
            </div>

            <div class="submit-container">
                <button type="submit" name="create" class="submit-btn">Creer les Pokemons et commencer le combat</button>
            </div>
        </form>

        <div class="back-link">
            <a href="index.php">Retour à l'accueil</a>
        </div>
    </div>
</body>

</html>