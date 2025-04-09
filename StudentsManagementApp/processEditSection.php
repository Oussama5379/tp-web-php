<?php
include_once "autoloader.php";
session_start();
$id=$_POST["id"];
$designation = $_POST['designation'];
$description = $_POST['description'];
$db = ConnexionDB::getInstance();
$user=new User($db);
if (isset($designation) && isset($designation) ) {
    $user->editSection($id,$designation,$description);
}
header('Location: sectionsList.php');
exit;
