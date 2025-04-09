<?php
include 'Etudiant.php';

$etudiants = [
    new Etudiant("Aymen", [11, 13, 18, 7, 10, 13, 2, 5, 1]),
    new Etudiant("Skander", [15, 9, 8, 16])
];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Notes des étudiants</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
foreach ($etudiants as $etudiant) {
    echo "<div class='colonne'>";
    echo "<strong>" . $etudiant->nom . "</strong>";
    $etudiant->afficherNotes();
    $moyenne = $etudiant->calculerMoyenne();
    echo "<div class='moyenne'>Votre moyenne est " . $moyenne . "</div>";
    echo "</div>";
}
?>

</body>
</html>