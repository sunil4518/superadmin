<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    mysqli_query($link, "DELETE FROM product WHERE id = $id");
}

header("Location: Product.php");
exit();
?>
