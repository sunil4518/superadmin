<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
<?php include 'config.php'; ?>

<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['service_id'])) {
    $service_id = mysqli_real_escape_string($link, $_POST['service_id']);

    $query = mysqli_query($link, "SELECT amount FROM product WHERE id = '$service_id' AND status = 'Active'");
    $result = mysqli_fetch_assoc($query);

    header('Content-Type: application/json');
    echo json_encode(['amount' => $result ? $result['amount'] : '']);
    exit;
}
?>



<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Client Form')); ?>
    <?php include 'layouts/head-css.php'; ?>
</head>

<body>
    <div id="layout-wrapper">
        <?php include 'layouts/menu.php'; ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <section class="gradient-custom">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-10">
                                    <div class="card shadow-lg" style="border-radius: 15px;">
                                        <div class="card-body p-4">
                                            <h4 class="mb-3">Client Detail</h4>
                                            <form method="POST" action="summary.php">
                                                <!-- Client Details -->
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" name="name" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Organization</label>
                                                        <input type="text" name="organization" class="form-control">
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Number</label>
                                                        <input type="text" name="number" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" name="email" class="form-control" required>
                                                    </div>
                                                </div>

                                                <!-- Address -->
                                                <h4 class="mb-3">Address</h4>
                                                <div class="row">
                                                    <div class="mb-3 col-md-8">
                                                        <label class="form-label">Address</label>
                                                        <input type="text" name="address" class="form-control" required>
                                                    </div>
                                                    <div class="mb-3 col-md-4">
                                                        <label class="form-label">Zip Code</label>
                                                        <input type="text" name="zipcode" class="form-control" required>
                                                    </div>
                                                </div>

                                                <!-- Service Details -->
                                                <h4 class="mb-3">Service Detail</h4>
                                                <div class="row">
                                                    <!-- Service Name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Service Name</label>
                                                        <select name="service_name" class="form-control" id="serviceDropdown" required>
                                                            <option value="">Select Service</option>
                                                            <?php
                                                            $query = mysqli_query($link, "SELECT id, service FROM product WHERE status = 'Active'");
                                                            while ($row = mysqli_fetch_assoc($query)) {
                                                                echo '<option value="' . $row['id'] . '">' . $row['service'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <!-- Service Amount -->
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Service Amount</label>
                                                        <input type="text" name="amount" class="form-control" id="serviceAmount" required readonly>
                                                    </div>

                                                    <!-- Coupon Code -->
                                                    <div class="mb-3 col-md-8">
                                                        <label class="form-label">Coupon Code</label>
                                                        <input type="text" name="coupon_code" class="form-control" id="couponCode">
                                                    </div>
                                                    <div class="mb-3 col-md-4 d-flex align-items-end">
                                                        <button type="button" class="btn btn-info w-100" id="applyCoupon">Apply</button>
                                                    </div>

                                                    <!-- Discount Amount -->
                                                    <div class="mb-3 col-md-4">
                                                        <label class="form-label">Discount Amount</label>
                                                        <!-- <input type="number" id="discountAmount" class="form-control" readonly> -->
                                                        <input type="number" id="discountAmount" name="discount_amount" class="form-control" readonly>

                                                    </div>

                                                    <!-- Token Amount -->
                                                    <div class="mb-3 col-md-4">
                                                        <label class="form-label">Token Amount</label>
                                                        <input type="number" name="token_amount" class="form-control">
                                                    </div>

                                                    <!-- GST Amount -->
                                                    <div class="mb-3 col-md-4">
                                                        <label class="form-label">GST Amount</label>
                                                        <input type="number" name="gst_amount" class="form-control">
                                                    </div>

                                                    <!-- Payable Amount -->
                                                    <div class="mb-3 col-md-4">
                                                        <label class="form-label">Payable Amount</label>
                                                        <input type="number" name="payable_amount" class="form-control" id="payableAmount" readonly>
                                                    </div>
                                                </div>

                                                <!-- Submit -->
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-primary">Next</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <?php include 'layouts/footer.php'; ?>
            </div>
        </div>
    </div>

    <?php include 'layouts/vendor-scripts.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
<!-- data fetch a service amount   -->
<script>
    $(document).ready(function() {
        // Fetch service amount
        $('#serviceDropdown').on('change', function() {
            var serviceId = $(this).val();
            if (serviceId !== '') {
                $.ajax({
                    url: "fetch-amount.php",
                    method: "POST",
                    data: {
                        service_id: serviceId
                    },
                    dataType: "json",
                    success: function(data) {
                        var amount = parseFloat(data.amount);
                        var gstrate = parseFloat(data.gstrate);
                        var gstAmount = (amount * gstrate / 100).toFixed(2);

                        var payable = (amount + parseFloat(gstAmount)).toFixed(2);

                        $('#serviceAmount').val(amount);
                        $('input[name="gst_amount"]').val(gstAmount);
                        $('#discountAmount').val('');
                        $('#payableAmount').val(payable);
                    }
                });
            } else {
                $('#serviceAmount').val('');
                $('input[name="gst_amount"]').val('');
                $('#payableAmount').val('');
            }
        });


        // Apply coupon
        $('#applyCoupon').on('click', function() {
            var coupon = $('#couponCode').val();
            var serviceAmount = parseFloat($('#serviceAmount').val());

            if (coupon !== '' && !isNaN(serviceAmount)) {
                $.ajax({
                    url: "apply-coupon.php",
                    method: "POST",
                    data: {
                        coupon: coupon,
                        serviceAmount: serviceAmount
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error) {
                            alert(response.error);
                            $('#discountAmount').val('');
                            $('#payableAmount').val(serviceAmount);
                        } else {
                            $('#discountAmount').val(response.discount);
                            $('#payableAmount').val(response.payable);
                        }
                    }
                });
            } else {
                alert("Please select a service and enter a valid coupon.");
            }
        });
    });
</script>


</html>