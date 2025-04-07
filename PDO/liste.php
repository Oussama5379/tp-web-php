<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <title>La liste des etudiants</title>
</head>
<body>
    <?php
        include "autoloader.php";
        $db = ConnexionDb::getInstance();
        $query="Select * from student";
        $response=$db->query($query);
        $listeEtudiants=$response->fetchAll(PDO::FETCH_OBJ);

    ?>
        <table class="table">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Name</th>
            <th scope="col">Birthday</th>
            <th>Détails</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listeEtudiants as $etudiant): ?>
            <tr>
                <td ><?= $etudiant->id ?></td>
                <td ><?= $etudiant->name ?></td>
                <td><?= $etudiant->birthday ?></td>
                <td>
                    <a href="detailsEtudiant.php?id=<?= $etudiant->id ?>">Détails</a>
                </td>
                
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
   
</body>
</html>