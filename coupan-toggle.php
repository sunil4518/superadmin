<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = mysqli_query($link, "SELECT status FROM coupan WHERE id = $id");
    if ($row = mysqli_fetch_assoc($query)) {
        $newStatus = ($row['status'] === 'Active') ? 'InActive' : 'Active';
        mysqli_query($link, "UPDATE coupan SET status = '$newStatus' WHERE id = $id");

        // Redirect back to the coupon list
        header("Location: coupan.php"); // Make sure this matches your actual list page filename
        exit;
    } else {
        echo 'Invalid Coupon ID';
    }
} else {
    echo 'ID not provided';
}
?>