<?php
include 'layouts/session.php';
include 'layouts/main.php';
include 'config.php';

// Handle AJAX request to get amount for selected service
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
                            <div class="col-lg-8">
                                <div class="card shadow-lg" style="border-radius: 15px;">
                                    <div class="card-body p-4">
                                        <form method="POST" action="summary.php" id="multiStepForm">
                                            <!-- Step 1 -->
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
                                                    <div class="col-md-3 mb-3">
                                                        <label>State</label>
                                                        <select name="state" id="stateSelect" class="form-control" required>
                                                            <option value="">Select State</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label>City</label>
                                                        <select name="city" id="citySelect" class="form-control" required>
                                                            <option value="">Select City</option>
                                                        </select>
                                                    </div>
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

                                            <!-- Step 2 -->
                                            <div class="form-step d-none" id="step2">
                                                <h4 class="mb-3">Summary</h4>
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span>Service Amount</span>
                                                    <span><strong id="serviceAmountDisplay">₹0</strong></span>
                                                </div>
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span>Discount -75%</span>
                                                    <span class="text-success" id="discountDisplay">−₹0</span>
                                                </div>
                                                <hr>
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span>Subtotal</span>
                                                    <span><strong id="subtotalDisplay">₹0</strong></span>
                                                </div>
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span>GST (18%)</span>
                                                    <span class="text-success" id="gstDisplay">+₹0</span>
                                                </div>
                                                <hr>
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span>Payable Amount</span>
                                                    <span class="text-success" id="payableDisplay">₹0</span>
                                                </div>

                                                <div class="mt-3">
                                                    <a href="javascript:void(0)" id="showCouponField" style="color: #5c2cc0; font-weight: 500;">Have a coupon code?</a>
                                                    <div class="row mt-2 d-none" id="couponRow">
                                                        <div class="col-6">
                                                            <input type="text" id="couponCode" class="form-control" placeholder="Enter coupon code">
                                                        </div>
                                                        <div class="col-6">
                                                            <button type="button" id="applyCoupon" class="btn btn-primary">Apply</button>
                                                        </div>
                                                    </div>

                                                    <div id="freeOfferMessage" class="alert alert-success d-flex justify-content-center align-items-center mt-3" style="background-color: #e6f7f5; color: #000; border-radius: 8px;">
                                                        <span>Great news! Your <strong>FREE</strong> domain + 2 months <strong>FREE</strong> are included with this order.</span>
                                                       
                                                    </div>
                                                </div>

                                                <!-- Hidden Fields -->
                                                <input type="hidden" id="serviceAmount" name="service_amount">
                                                <input type="hidden" id="gstAmount" name="gst_amount">
                                                <input type="hidden" id="discountAmount" name="discount_amount">
                                                <input type="hidden" id="payableAmount" name="payable_amount">

                                                <div class="d-flex justify-content-between mt-4">
                                                    <button type="button" class="btn btn-primary" onclick="nextStep(1)">Back</button>
                                                    <button type="submit" class="btn btn-primary">Continue</button>
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

<script>
    const apiKey = 'RjE1OUx0VTRYRXBjbzF4TEJoSk9TWnhEN1NzZmhNOUFjakswVVp0cg==';
    const countryCode = 'IN';
    const stateSelect = document.getElementById('stateSelect');
    const citySelect = document.getElementById('citySelect');

    async function fetchStates() {
        const response = await fetch(`https://api.countrystatecity.in/v1/countries/${countryCode}/states`, {
            headers: { 'X-CSCAPI-KEY': apiKey }
        });
        const states = await response.json();
        states.forEach(state => {
            const option = document.createElement('option');
            option.value = state.iso2;
            option.textContent = state.name;
            stateSelect.appendChild(option);
        });
    }

    async function fetchCities(stateCode) {
        const response = await fetch(`https://api.countrystatecity.in/v1/countries/${countryCode}/states/${stateCode}/cities`, {
            headers: { 'X-CSCAPI-KEY': apiKey }
        });
        const cities = await response.json();
        citySelect.innerHTML = '<option value="">Select City</option>';
        cities.forEach(city => {
            const option = document.createElement('option');
            option.value = city.name;
            option.textContent = city.name;
            citySelect.appendChild(option);
        });
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

    function nextStep(stepNum) {
        document.querySelectorAll('.form-step').forEach(step => step.classList.add('d-none'));
        document.getElementById(`step${stepNum}`).classList.remove('d-none');
    }

    function dismissOffer() {
        document.getElementById("freeOfferMessage").style.display = "none";
    }

    $('#showCouponField').on('click', function () {
        $('#couponRow').toggleClass('d-none');
    });

    $('#serviceDropdown').on('change', function () {
        const serviceId = $(this).val();
        if (serviceId !== '') {
            $.ajax({
                url: '', // same file
                method: 'POST',
                data: { service_id: serviceId },
                success: function (data) {
                    const amount = parseFloat(data.amount);
                    const discount = amount * 0.75;
                    const subtotal = amount - discount;
                    const gst = subtotal * 0.18;
                    const payable = subtotal + gst;

                    $('#serviceAmount').val(amount);
                    $('#discountAmount').val(discount.toFixed(2));
                    $('#gstAmount').val(gst.toFixed(2));
                    $('#payableAmount').val(payable.toFixed(2));

                    $('#serviceAmountDisplay').text('₹' + amount.toFixed(2));
                    $('#discountDisplay').text('−₹' + discount.toFixed(2));
                    $('#subtotalDisplay').text('₹' + subtotal.toFixed(2));
                    $('#gstDisplay').text('+₹' + gst.toFixed(2));
                    $('#payableDisplay').text('₹' + payable.toFixed(2));
                }
            });
        }
    });
</script>
</body>
