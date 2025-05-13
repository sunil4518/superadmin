<?php
include 'config.php';

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $query = mysqli_query($link, "SELECT status FROM product WHERE id = $id");
    $row = mysqli_fetch_assoc($query);

    if ($row) {
        $newStatus = $row['status'] === 'Active' ? 'Inactive' : 'Active';
        mysqli_query($link, "UPDATE product SET status = '$newStatus' WHERE id = $id");
        echo $newStatus;
    } else {
        echo "Error";
    }
}
?>
