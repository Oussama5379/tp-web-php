<?php
include 'autoloader.php';
include 'isAuthentificated.php';

$db = ConnexionDB::getInstance();
$user = new User($db);


if($user->getRole($_SESSION['username'])!="admin") {
    header('Location: sectionsList.php');
    exit;
}
if (isset($_GET['id'])) {
    $user->deleteSection($_GET['id']);
}
header('Location: sectionsList.php');
exit;