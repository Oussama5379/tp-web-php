<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'etudiant</title>
</head>
<body>
    <?php 
        include_once "autoloader.php";
        $db = ConnexionDb::getInstance();
        $id=$_GET["id"];
        if (!isset($id)) {
            header('Location: liste.php');
        }
        $query = "SELECT * from student  where id = :id ;";
        $response =$db->prepare($query);
        $response->execute(['id' => $id]);
        $details= $response->fetch(PDO::FETCH_OBJ);
        
        if (!$details) {
            header('Location: liste.php');
        }
    ?>
    <p>l'etudiant est <?php echo $details->name ?> et sa date de naissance est le <?php echo $details->birthday ?></p>
</body>
</html>