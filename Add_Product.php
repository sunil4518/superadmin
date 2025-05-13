<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
<?php include 'config.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ServiceName = $_POST['ServiceName'];
    $Amount = $_POST['Amount'];
    $GST = $_POST['GST'];
    $state = $_POST['state'];
    $Description = $_POST['Description'];
    $service_type = "Individual";


    $sql = "INSERT INTO product (service, amount, gstrate, state, description, service_type) 
            VALUES ('$ServiceName', '$Amount', '$GST', '$state', '$Description', '$service_type')";


    if (mysqli_query($link, $sql)) {
        $_SESSION['success'] = 'Product Added Successfully';
        header('Location: Product.php');
    } else {
        echo 'Error: ' . mysqli_error($link);
    }
}
?>

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Add Employee')); ?>
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
                                <div class="col-lg-12">
                                    <div class="card shadow-lg" style="border-radius: 15px;">
                                        <div class="card-body p-4">
                                            <a class="btn btn-success mb-3" href="Product.php"><i class="fa-solid fa-arrow-left"></i> Back</a>
                                            <form method="POST">
                                                <!-- Repeat for each field -->
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label>Service Name</label>
                                                        <input type="text" name="ServiceName" class="form-control" required>
                                                    </div>
                                                     <div class="col-md-6 mb-3">
                                                        <label>Service Amount</label>
                                                        <input type="text" name="Amount" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>GST Rate</label>
                                                        <input type="text" name="GST" class="form-control" required>
                                                    </div>
                                                   
                                                    <div class="col-md-6 mb-3"><label>State</label><select name="state" id="stateSelect" class="form-control" required>
                                                            <option value="">Select State</option>
                                                        </select></div>
                                                    </div>
                                                  <div class="col-md-12 mb-3">
                                                        <label>Description</label>
                                                        <input type="text" name="Description" class="form-control" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary mt-3">Add Employee</button>
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
</body>
<script>
    const apiKey = 'RjE1OUx0VTRYRXBjbzF4TEJoSk9TWnhEN1NzZmhNOUFjakswVVp0cg==';
    const countryCode = 'IN';
    const stateSelect = document.getElementById('stateSelect');

    async function fetchStates() {
        try {
            const response = await fetch(`https://api.countrystatecity.in/v1/countries/${countryCode}/states`, {
                headers: {
                    'X-CSCAPI-KEY': apiKey
                }
            });

            const states = await response.json();

            // Clear any existing options (optional)
            stateSelect.innerHTML = '<option value="">Select State</option>';

            states.forEach(state => {
                const option = document.createElement('option');
                option.value = state.name;  // Using full name as value
                option.textContent = state.name; // Displaying full name
                stateSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Error fetching states:', error);
        }
    }

    fetchStates();
</script>






</html>