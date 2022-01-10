<?php

session_start();

$_SESSION = array();
echo "TRUE";
session_destroy();

header("location: login.php");

exit;
?>
