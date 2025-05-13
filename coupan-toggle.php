<?php
include 'config.php';

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Get current status
    $query = "SELECT status FROM coupan WHERE id = $id";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $newStatus = ($row['status'] === 'Active') ? 'InActive' : 'Active';

        // Update status
        $updateQuery = "UPDATE coupan SET status = '$newStatus' WHERE id = $id";
        if (mysqli_query($link, $updateQuery)) {
            echo $newStatus;
        } else {
            echo "Error";
        }
    } else {
        echo "NotFound";
    }
} else {
    echo "Invalid";
}
?>
