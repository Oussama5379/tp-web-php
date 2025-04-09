<?php
include 'autoloader.php';
include 'isAuthentificated.php';

$db = ConnexionDB::getInstance();
$user = new User($db);


if($user->getRole($_SESSION['username'])!="admin") {
    header('Location: StudentsList.php');
    exit;
}
if (isset($_GET['id'])) {
    $user->deleteStudent($_GET['id']);
}
header('Location: studentsList.php');
exit;