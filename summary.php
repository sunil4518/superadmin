<?php
// summary.php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $clientData = $_POST;
} else {
    // Direct access
    header("Location: client-form.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Client Summary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Client Summary</h2>
            <button class="btn btn-success" onclick="downloadSummary()">Download</button>
        </div>

        <div class="card p-4">
            <h5 class="mb-3">Client Details</h5>
            <p><strong>Name:</strong> <?= htmlspecialchars($clientData['name']) ?></p>
            <p><strong>Organization:</strong> <?= htmlspecialchars($clientData['organization']) ?></p>
            <p><strong>Number:</strong> <?= htmlspecialchars($clientData['number']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($clientData['email']) ?></p>

            <h5 class="mt-4 mb-3">Address</h5>
            <p><strong>Address:</strong> <?= htmlspecialchars($clientData['address']) ?></p>
            <p><strong>Zip Code:</strong> <?= htmlspecialchars($clientData['zipcode']) ?></p>

            <h5 class="mt-4 mb-3">Service Details</h5>
            <p><strong>Service ID:</strong> <?= htmlspecialchars($clientData['service_name']) ?></p>
            <p><strong>Amount:</strong> ₹<?= htmlspecialchars($clientData['amount']) ?></p>
            <p><strong>Coupon Code:</strong> <?= htmlspecialchars($clientData['coupon_code']) ?></p>
            <p><strong>Discount Amount:</strong> ₹<?= htmlspecialchars($clientData['discount_amount'] ?? 0) ?></p>
            <p><strong>Token Amount:</strong> ₹<?= htmlspecialchars($clientData['token_amount']) ?></p>
            <p><strong>GST Amount:</strong> ₹<?= htmlspecialchars($clientData['gst_amount']) ?></p>
            <p><strong>Payable Amount:</strong> ₹<?= htmlspecialchars($clientData['payable_amount']) ?></p>
        </div>
    </div>

    <script>
        function downloadSummary() {
            const content = `
Client Summary

Name: <?= addslashes($clientData['name']) ?>

Organization: <?= addslashes($clientData['organization']) ?>
Number: <?= addslashes($clientData['number']) ?>
Email: <?= addslashes($clientData['email']) ?>

Address: <?= addslashes($clientData['address']) ?>, Zip Code: <?= addslashes($clientData['zipcode']) ?>

Service ID: <?= addslashes($clientData['service_name']) ?>
Amount: ₹<?= addslashes($clientData['amount']) ?>
Coupon Code: <?= addslashes($clientData['coupon_code']) ?>
Discount Amount: ₹<?= addslashes($clientData['discount_amount'] ?? 0) ?>
Token Amount: ₹<?= addslashes($clientData['token_amount']) ?>
GST Amount: ₹<?= addslashes($clientData['gst_amount']) ?>
Payable Amount: ₹<?= addslashes($clientData['payable_amount']) ?>
            `;

            const blob = new Blob([content], {
                type: 'text/plain'
            });
            const url = URL.createObjectURL(blob);
            const a = document.createElement("a");
            a.href = url;
            a.download = "client-summary.txt";
            a.click();
            URL.revokeObjectURL(url);
        }
    </script>
</body>

</html>