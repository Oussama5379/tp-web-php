<?php
include_once "autoloader.php";
session_start();
$id=$_POST["id"];
$name = $_POST['name'];
$birthday = $_POST['birthday'];
$section=$_POST["section"];

$db = ConnexionDB::getInstance();
$user=new User($db);
if (isset($name) && isset($birthday) && isset($section)) {
    $user->editStudent($id,$name,$birthday,$section);
}
header('Location: studentsList.php');
exit;
