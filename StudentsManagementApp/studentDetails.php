<?php include "fragments/header.php";
 include_once "autoloader.php";
 $db = ConnexionDb::getInstance();
 $id=$_GET["id"];
 if (!isset($id)) {
     header('Location: index.php');
 }
 $studentObject=new Student($db);
 $student=$studentObject->getStudentById($id);
 if (!$student) {
    header('Location: liste.php');
}
?>
<p>l'etudiant est <?php echo $student['name'] ?> ,sa date de naissance est le <?php echo $student['birthday']?> et son filière est
 <?php echo $student['section'] ?></p>
<?php include "fragments/footer.php"; ?>