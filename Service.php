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

                                            <form method="POST" action="summary.php" id="multiStepForm">
                                                <!-- Step 1 - Client Detail -->
                                                <div class="form-step" id="step1">
                                                    <h4 class="mb-3">Client Details</h4>
                                                    <div class="row">
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label">Name</label>
                                                            <input type="text" name="name" class="form-control" required>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label">Number</label>
                                                            <input type="text" name="number" class="form-control" required>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label">Email</label>
                                                            <input type="email" name="email" class="form-control" required>
                                                        </div>
                                                        <div class="col-md-3 mb-3"><label>State</label><select name="state"
                                                            id="stateSelect" class="form-control" required>
                                                            <option value="">Select State</option>
                                                        </select></div>
                                                    <div class="col-md-3 mb-3"><label>City</label><select name="city"
                                                            id="citySelect" class="form-control" required>
                                                            <option value="">Select City</option>
                                                        </select></div>
                                                           <div class="col-md-6 mb-3">
                                                        <label>Pincode</label>
                                                        <input type="text" name="pincode" class="form-control">
                                                    </div>
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
                                                      <div class="col-md-12 mb-3">
                                                        <label>Address</label>
                                                        <input type="text" name="addressline" class="form-control">
                                                    </div>
                                                    </div>
                                                       
                                                    <div class="text-end">
                                                        <button type="button" class="btn btn-primary" onclick="nextStep(2)">Next</button>
                                                    </div>
                                                </div>

                                                <!-- Step 2 - Address & Service -->
                                                <div class="form-step d-none" id="step2">
                                                    <h4 class="mb-3">Billing Details</h4>
                                                    <div class="row">
                                                       
                                                     
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label">Service Amount</label>
                                                            <input type="text" name="amount" class="form-control" id="serviceAmount" readonly>
                                                        </div>
                                                          <div class="mb-3 col-md-4">
                                                            <label class="form-label">Coupon Code</label>
                                                            <input type="text" name="coupon_code" class="form-control" id="couponCode">
                                                        </div>
                                                        <div class="mb-3 col-md-2 d-flex align-items-end">
                                                            <button type="button" class="btn btn-info w-100" id="applyCoupon">Apply</button>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label">Discount Amount</label>
                                                            <input type="number" id="discountAmount" name="discount_amount" class="form-control" readonly>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="form-label">Token Amount</label>
                                                            <input type="number" name="token_amount" class="form-control">
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="form-label">GST Amount</label>
                                                            <input type="number" name="gst_amount" class="form-control">
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="form-label">Payable Amount</label>
                                                            <input type="number" name="payable_amount" class="form-control" id="payableAmount" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button type="button" class="btn btn-secondary" onclick="nextStep(1)">Previous</button>
                                                        <button type="button" class="btn btn-primary" onclick="nextStep(3)">Next</button>
                                                    </div>
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
    const apiKey = 'RjE1OUx0VTRYRXBjbzF4TEJoSk9TWnhEN1NzZmhNOUFjakswVVp0cg==';
    const countryCode = 'IN';
    const stateSelect = document.getElementById('stateSelect');
    const citySelect = document.getElementById('citySelect');

    async function fetchStates() {
        try {
            const response = await fetch(`https://api.countrystatecity.in/v1/countries/${countryCode}/states`, {
                headers: {
                    'X-CSCAPI-KEY': apiKey
                }
            });
            const states = await response.json();
            states.forEach(state => {
                const option = document.createElement('option');
                option.value = state.iso2;
                option.textContent = state.name;
                stateSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Error fetching states:', error);
        }
    }

    async function fetchCities(stateCode) {
        try {
            const response = await fetch(`https://api.countrystatecity.in/v1/countries/${countryCode}/states/${stateCode}/cities`, {
                headers: {
                    'X-CSCAPI-KEY': apiKey
                }
            });
            const cities = await response.json();
            citySelect.innerHTML = '<option value="">Select City</option>';
            cities.forEach(city => {
                const option = document.createElement('option');
                option.value = city.name;
                option.textContent = city.name;
                citySelect.appendChild(option);
            });
        } catch (error) {
            console.error('Error fetching cities:', error);
        }
    }

    stateSelect.addEventListener('change', () => {
        const selectedState = stateSelect.value;
        if (selectedState) {
            fetchCities(selectedState);
        } else {
            citySelect.innerHTML = '<option value="">Select City</option>';
        }
    });

    fetchStates();
</script>
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
                            var gstAmount = parseFloat($('input[name="gst_amount"]').val()) || 0;
                            $('#payableAmount').val((serviceAmount + gstAmount).toFixed(2));
                        } else {
                            $('#discountAmount').val(response.discount);
                            var gstAmount = parseFloat($('input[name="gst_amount"]').val()) || 0;
                            var payableWithGST = parseFloat(response.payable) + gstAmount;
                            $('#payableAmount').val(payableWithGST.toFixed(2));
                        }
                    }
                });
            } else {
                alert("Please select a service and enter a valid coupon.");
            }
        });

    });
</script>
<script>
    function nextStep(step) {
        $('.form-step').addClass('d-none');
        $('#step' + step).removeClass('d-none');
    }
</script>



</html>