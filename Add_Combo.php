<?php
include 'layouts/session.php';
include 'layouts/main.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['services']) && is_array($_POST['services'])) {
        $mainService = mysqli_real_escape_string($link, $_POST['service']);
        $description = mysqli_real_escape_string($link, $_POST['description']);
        $state = mysqli_real_escape_string($link, $_POST['state']); // hidden input
        $gstrate = mysqli_real_escape_string($link, $_POST['gstrate']) . '%';
        $service_type = 'Combo_Service';
        $status = "Active";

        $comboServices = $_POST['services'];
        $combo_detail = implode(', ', array_map(function ($service) use ($link) {
            return mysqli_real_escape_string($link, $service);
        }, $comboServices));

        // Calculate total amount of selected services
        $amount = 0;
        foreach ($comboServices as $service) {
            $escapedService = mysqli_real_escape_string($link, $service);
            $amountQuery = "SELECT amount FROM product WHERE service = '$escapedService' LIMIT 1";
            $result = mysqli_query($link, $amountQuery);
            if ($row = mysqli_fetch_assoc($result)) {
                $amount += floatval($row['amount']);
            }
        }

        // Insert combo service
        $insertQuery = "INSERT INTO product(service, service_type, combo_detail, amount, description, state, gstrate, status)
                        VALUES('$mainService', '$service_type', '$combo_detail', '$amount', '$description', '$state', '$gstrate', '$status')";

        if (mysqli_query($link, $insertQuery)) {
            $_SESSION['success'] = 'Combo Service Inserted Successfully';
            header('Location: product.php');
            exit();
        } else {
            echo "<div class='alert alert-danger'>Error: " . mysqli_error($link) . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Please select at least one service.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Combo Service')); ?>
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
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <a class="btn btn-success" href="product.php"><i class="fa-solid fa-arrow-left"></i> Back</a>
                                            </div>
                                            <form method="POST">
                                                <input type="hidden" name="state" id="state" />
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="service" class="form-label">Service Name</label>
                                                        <input type="text" name="service" id="service" class="form-control" placeholder="Enter Combo Service Name" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Total Amount</label>
                                                        <input type="text" class="form-control" id="serviceAmount" name="serviceAmount" readonly>
                                                    </div>

                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label">Select Services</label>
                                                        <div class="row">
                                                            <?php
                                                            $query = "SELECT DISTINCT service, amount FROM product WHERE service IS NOT NULL AND service != ''";
                                                            $result = mysqli_query($link, $query);
                                                            $count = 0;

                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $service = htmlspecialchars($row['service']);
                                                                $amount = floatval($row['amount']);

                                                                echo '<div class="col-md-4">';
                                                                echo '<div class="form-check">';
                                                                echo '<input class="form-check-input service-checkbox" type="checkbox" data-amount="' . $amount . '" value="' . $service . '" name="services[]" id="' . $service . '">';
                                                                echo '<label class="form-check-label" for="' . $service . '">' . $service . ' </label>';
                                                                echo '</div>';
                                                                echo '</div>';

                                                                $count++;
                                                                if ($count % 3 == 0) echo '</div><div class="row">';
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6 mb-3">
                                                        <label for="stateSelect" class="form-label">Select State</label>
                                                        <select id="stateSelect" class="form-control mb-2">
                                                            <option value="">Select State</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label for="gstrate" class="form-label">GST Rate (%)</label>
                                                        <input type="text" name="gstrate" id="gstrate" class="form-control" placeholder="Enter GST rate" required>
                                                    </div>
                                                    <div class="col-md-12 mb-6">
                                                        <label for="description" class="form-label">Description</label>
                                                        <input type="text" name="description" id="description" class="form-control" placeholder="Enter description" required>
                                                    </div>
                                                    <div class="col-md-6 mt-4 mb-3 d-flex align-items-end">
                                                      <button type="submit" class="btn btn-primary mt-3">Create</button>
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
            </div>
            <?php include 'layouts/footer.php'; ?>
        </div>
    </div>

    <?php include 'layouts/vendor-scripts.php'; ?>

    <!-- JavaScript -->
    <script>
        const apiKey = 'RjE1OUx0VTRYRXBjbzF4TEJoSk9TWnhEN1NzZmhNOUFjakswVVp0cg==';
        const countryCode = 'IN';
        const stateInput = document.getElementById('state');
        const stateSelect = document.getElementById('stateSelect');

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
                    option.dataset.stateName = state.name;
                    stateSelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error fetching states:', error);
            }
        }

        stateSelect.addEventListener('change', () => {
            const selectedOption = stateSelect.options[stateSelect.selectedIndex];
            const stateName = selectedOption.dataset.stateName;
            stateInput.value = stateName;
        });

        fetchStates();

        // Amount Calculation
        document.addEventListener("DOMContentLoaded", function() {
            let totalAmount = 0;
            const amountField = document.getElementById("serviceAmount");

            document.querySelectorAll(".service-checkbox").forEach(function(checkbox) {
                checkbox.addEventListener("change", function() {
                    const amount = parseFloat(this.getAttribute("data-amount"));
                    if (this.checked) {
                        totalAmount += amount;
                    } else {
                        totalAmount -= amount;
                    }
                    amountField.value = totalAmount.toFixed(2);
                });
            });
        });
    </script>

</body>

</html>