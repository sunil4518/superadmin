<?php
session_start();
$_SESSION = array();
session_destroy();
header("Location: auth-signup-cover.php");
exit;
?>
