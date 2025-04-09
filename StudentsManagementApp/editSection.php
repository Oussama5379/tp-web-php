<?php
include 'autoloader.php';
include 'isAuthentificated.php';
$pageTitle="Edit Section";
include "fragments/header.php";
$db = ConnexionDB::getInstance();
$user = new User($db);
if($user->getRole($_SESSION['username'])!="admin") {
    header('Location: sectionsList.php');
    exit;
}

?>

<form action="processEditSection.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
    designation : <input name="designation" type="text" class="form-control">
    description : <input name="description" type="text" class="form-control">
    
    <button class="btn btn-primary" type="submit">
        Modifier la section
    </button>
</form>

<?php
include "fragments/footer.php";


?>