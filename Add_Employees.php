<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
<?php include 'config.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $emergency_number = $_POST['Alternatenumber'];
    $addressline = $_POST['addressline'];
    $pincode = $_POST['pincode'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $aadhar_number = $_POST['aadhar_number'];
    $pan_number = $_POST['pan_number'];
    $qualification = $_POST['qualification'];
    $bank_name = $_POST['bank_name'];
    $account_number = $_POST['account_number'];
    $ifsc_code = $_POST['ifsc_code'];
    $work_experience = $_POST['work_experience'];
    $join_date = $_POST['join_date'];
    $branch = $_POST['branch'];
    $department = $_POST['department'];
    $designation = $_POST['designation'];
    $status = "Active";

    $sql = "INSERT INTO employees (fullname, email,  number,  emergency_number, addressline, pincode, city, state, aadhar_number, pan_number, qualification, bank_name, account_number, ifsc_code,  work_experience, join_date, branch, department, designation, password, created_at, status)      
    VALUES ('$fullname', '$email', '$number', '$emergency_number', '$addressline', '$pincode', '$city', '$state', '$aadhar_number', '$pan_number', '$qualification', '$bank_name', '$account_number', '$ifsc_code', '$work_experience', '$join_date', '$branch', '$department', '$designation', '$password', NOW(), '$status'
)";

    if (mysqli_query($link, $sql)) {
        $_SESSION['success'] = 'Employee Inserted Successfully';
        header('Location: Employees.php');
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
                                            <a class="btn btn-success mb-3" href="Employees.php"><i class="fa-solid fa-arrow-left"></i> Back</a>
                                            <form method="POST">
                                                <!-- Repeat for each field -->
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label>Full Name</label>
                                                        <input type="text" name="fullname" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Email</label>
                                                        <input type="email" name="email" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Mobile Number</label>
                                                        <input type="text" name="number" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Alternate Number</label>
                                                        <input type="text" name="Alternatenumber" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Address</label>
                                                        <input type="text" name="addressline" class="form-control">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label>Pincode</label>
                                                        <input type="text" name="pincode" class="form-control">
                                                    </div>
                                                    <div class="col-md-3 mb-3"><label>State</label><select name="state" id="stateSelect" class="form-control" required>
                                                            <option value="">Select State</option>
                                                        </select></div>
                                                    <div class="col-md-3 mb-3"><label>City</label><select name="city" id="citySelect" class="form-control" required>
                                                            <option value="">Select City</option>
                                                        </select></div>
                                                    <div class="col-md-3 mb-3">
                                                        <label>Aadhar Number</label>
                                                        <input type="text" name="aadhar_number" id="aadhar_number" class="form-control" maxlength="12" required placeholder="Enter 12 digit Aadhar">
                                                    </div>


                                                    <div class="col-md-3 mb-3">
                                                        <label>PAN Number</label>
                                                        <input type="text" name="pan_number" id="pan_number" class="form-control" maxlength="10" pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}" title="Enter valid PAN format: AAAAA9999A" required placeholder="ABCDE1234F">
                                                    </div>

                                                    <div class="col-md-3 mb-3">
                                                        <label>Qualification</label>
                                                        <input type="text" name="qualification" class="form-control">
                                                    </div>
                                                    <div class="col-md-3 mb-3"><label>Bank Name</label>
                                                        <select name="bank_name" class="form-control" required>
                                                            <option value="">Select Bank</option>
                                                            <option>State Bank of India</option>
                                                            <option>Punjab National Bank</option>
                                                            <option>HDFC Bank</option>
                                                            <option>ICICI Bank</option>
                                                            <option>Axis Bank</option>
                                                            <option>Bank of Baroda</option>
                                                            <option>Union Bank of India</option>
                                                            <option>Canara Bank</option>
                                                            <option>Kotak Mahindra Bank</option>
                                                            <option>IDBI Bank</option>
                                                            <option>Bank of India</option>
                                                            <option>Indian Bank</option>
                                                            <option>Central Bank of India</option>
                                                            <option>Indian Overseas Bank</option>
                                                            <option>UCO Bank</option>
                                                            <option>Bank of Maharashtra</option>
                                                            <option>IndusInd Bank</option>
                                                            <option>Yes Bank</option>
                                                            <option>Federal Bank</option>
                                                            <option>South Indian Bank</option>
                                                            <option>RBL Bank</option>
                                                            <option>Karur Vysya Bank</option>
                                                            <option>Bandhan Bank</option>
                                                            <option>Punjab & Sind Bank</option>
                                                            <option>DCB Bank</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label>Account Number</label>
                                                        <input type="text" name="account_number" class="form-control">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label>IFSC Code</label>
                                                        <input type="text" name="ifsc_code" class="form-control">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label>Work Experience</label>
                                                        <input type="text" name="work_experience" class="form-control">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label>Join Date</label>
                                                        <input type="date" name="join_date" class="form-control">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label>Branch</label>
                                                        <select name="branch" id="branch" class="form-control" required>
                                                            <option value="">Select Branch</option>
                                                            <?php
                                                            $query = "SELECT DISTINCT branchname FROM branch";
                                                            $result = mysqli_query($link, $query);
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                echo "<option value='" . $row['branchname'] . "'>" . $row['branchname'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-3 mb-3">
                                                        <label>Department</label>
                                                        <select name="department" class="form-control" required>
                                                            <option value="">Select Department</option>
                                                            <?php
                                                            $query = "SELECT departmentname FROM department";
                                                            $result = mysqli_query($link, $query);
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                echo "<option value='" . $row['departmentname'] . "'>" . $row['departmentname'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label>Designation</label>
                                                        <select name="designation" class="form-control" required>
                                                            <option value="">Select Designation</option>
                                                            <?php
                                                            $query = "SELECT designationname FROM designation";
                                                            $result = mysqli_query($link, $query);
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                echo "<option value='" . $row['designationname'] . "'>" . $row['designationname'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-primary mt-3">Add Employee</button>
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
    // Aadhar Number: Allow only digits and limit to 12
    const aadharInput = document.getElementById("aadhar_number");
    if (aadharInput) {
        aadharInput.addEventListener("input", function(e) {
            let value = e.target.value.replace(/\D/g, ''); // Remove non-digits
            e.target.value = value.slice(0, 12); // Limit to 12 digits
        });
    }

    // PAN Number: Convert to uppercase, allow only alphanumeric, limit to 10
    const panInput = document.getElementById("pan_number");
    if (panInput) {
        panInput.addEventListener("input", function(e) {
            let value = e.target.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
            e.target.value = value.slice(0, 10);
        });
    }
</script>
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





</html>