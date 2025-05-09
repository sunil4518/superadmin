<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $query = mysqli_query($link, "SELECT status FROM employees WHERE id = $id");

    if ($row = mysqli_fetch_assoc($query)) {
        $newStatus = ($row['status'] === 'Active') ? 'InActive' : 'Active';
        mysqli_query($link, "UPDATE employees SET status = '$newStatus' WHERE id = $id");
        echo $newStatus;
    } else {
        echo 'error';
    }
}
?>
