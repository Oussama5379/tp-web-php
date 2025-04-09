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

<form action="processEdit.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
    name : <input name="name" type="text" class="form-control">
    birthday : <input name="birthday" type="date" class="form-control">
    <select name="section" id="section">
    <?php foreach ($sections as $section) { ?>
        <option value="<?= $section['id'] ?>">
            <?= htmlspecialchars($section['designation']) ?> 
        </option>
        <?php } ?>
    </select>
    <button class="btn btn-primary" type="submit">
        Edit
    </button>
</form>

<?php
include "fragments/footer.php";


?>