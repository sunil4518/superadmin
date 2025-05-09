<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $delete = mysqli_query($link, "DELETE FROM employees WHERE id = $id");

    if ($delete) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
