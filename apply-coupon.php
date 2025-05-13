<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['coupon']) && isset($_POST['serviceAmount'])) {
    $coupon = mysqli_real_escape_string($link, $_POST['coupon']);
    $serviceAmount = floatval($_POST['serviceAmount']);

    // Fetch coupon details
    $query = mysqli_query($link, "SELECT amount FROM coupan WHERE coupan = '$coupon' AND status = 'Active'");
    $result = mysqli_fetch_assoc($query);

    header('Content-Type: application/json');

    if ($result) {
        $discount = floatval($result['amount']);
        $payable = $serviceAmount - $discount;
        echo json_encode([
            'discount' => $discount,
            'payable' => $payable
        ]);
    } else {
        echo json_encode([
            'error' => 'Invalid or inactive coupon code.'
        ]);
    }
    exit;
}
?>
