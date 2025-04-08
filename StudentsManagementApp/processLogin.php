<?php
include_once "autoloader.php";
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$db = ConnexionDB::getInstance();
$user=new User($db);
if (isset($username) && isset($password)) {
    if ($user->isUserExist($username) && $user->getPassword($username)!="" && $user->getPassword($username)==$password ) {
        $_SESSION['username'] = $username;
        header("Location:index.php");
    } else {
    
        header("Location:login.php?errorMessage=Veuillez vérifier vos crédentials");
    }
}