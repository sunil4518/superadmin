<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $query = mysqli_query($link, "SELECT User_status FROM employees WHERE id = $id");

    if ($row = mysqli_fetch_assoc($query)) {
        $newUser_status = ($row['User_status'] === 'Active') ? 'InActive' : 'Active';
        mysqli_query($link, "UPDATE employees SET User_status = '$newUser_status' WHERE id = $id");
        echo $newUser_status;
    } else {
        echo 'error';
    }
}
?>
