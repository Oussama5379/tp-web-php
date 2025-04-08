<?php
$pageTitle = "Login";
include 'fragments/header.php';

?>
<form method="post" action="processLogin.php" enctype="multipart/form-data">
    username : <input name="username" type="text" class="form-control">
    password : <input name="password" type="password" class="form-control">
    <button class="btn btn-primary" type="submit">
        Login
    </button>
</form>
<?php if (isset($_GET['errorMessage'])) { ?>
    <div class="alert alert-danger">
        <?= $_GET['errorMessage'] ?>
    </div>
<?php } ?>


<?php include 'fragments/footer.php' ?>