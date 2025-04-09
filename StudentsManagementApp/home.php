<?php
$pageTitle="Home";
include_once 'fragments/header.php';
include_once 'isAuthentificated.php';
echo "<h2>Hello Mr ". $_SESSION['username']."</h2>";
echo "<h2>Your Role is : ".$_SESSION['role']."</h2>";
include_once 'fragments/footer.php';