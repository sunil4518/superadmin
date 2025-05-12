<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
<?php include 'config.php'; ?>
<?php
include 'config.php';
$id = $_GET['id'];
mysqli_query($link, "DELETE FROM coupan WHERE id = $id");
header("Location: Coupan.php");
exit();
