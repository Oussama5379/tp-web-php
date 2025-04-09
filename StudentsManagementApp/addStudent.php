<?php
include 'autoloader.php';
include 'isAuthentificated.php';
$pageTitle="Edit Student";
include "fragments/header.php";
$db = ConnexionDB::getInstance();
$user = new User($db);
if($user->getRole($_SESSION['username'])!="admin") {
    header('Location: StudentsList.php');
    exit;
}
$sectionObj=new Section($db);
$sections=$sectionObj->getListOfSections();
?>

<form action="processAddStudent.php" method="POST">
    name : <input name="name" type="text" class="form-control">
    birthday : <input name="birthday" type="date" class="form-control">
    imageUrl: <input type="text" name="image"><br>
    <select name="section" id="section">
    <?php foreach ($sections as $section) { ?>
        <option value="<?= $section['id'] ?>">
            <?= htmlspecialchars($section['designation']) ?> 
        </option>
        <?php } ?>
    </select>
    <button class="btn btn-primary" type="submit">
        Ajouter un étudiant
    </button>
</form>

<?php
include "fragments/footer.php";


?>