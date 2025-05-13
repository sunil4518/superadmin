<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['service_id'])) {
    $service_id = mysqli_real_escape_string($link, $_POST['service_id']);

    $query = mysqli_query($link, "SELECT amount, gstrate FROM product WHERE id = '$service_id' AND status = 'Active'");
    $result = mysqli_fetch_assoc($query);

    header('Content-Type: application/json');
    if ($result) {
        echo json_encode([
            'amount' => $result['amount'],
            'gstrate' => $result['gstrate']
        ]);
    } else {
        echo json_encode([
            'amount' => '',
            'gstrate' => ''
        ]);
    }
    exit;
}
?>
