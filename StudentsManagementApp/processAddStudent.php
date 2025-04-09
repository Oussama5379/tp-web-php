<?php
include_once "autoloader.php";
session_start();
$name = $_POST['name'];
$birthday = $_POST['birthday'];
$section=$_POST["section"];
$image=$_POST["image"];

$db = ConnexionDB::getInstance();
$user=new User($db);
if (isset($name) && isset($birthday) && isset($section) ) {
    $user->addStudent($id,$name,$birthday,$section,$image);
}
header('Location: studentsList.php');
exit;
