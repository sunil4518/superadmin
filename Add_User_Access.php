<?php
include 'layouts/session.php';
include 'layouts/main.php';
include 'config.php';

// Fetch employees for dropdown
$query = "SELECT id, fullname FROM employees";
$result = mysqli_query($link, $query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeeId = intval($_POST['Employeename']);
    $hashedPassword = password_hash($_POST['Password'], PASSWORD_DEFAULT);

    $updateQuery = "UPDATE employees SET password = ? WHERE id = ?";
    $stmt = mysqli_prepare($link, $updateQuery);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $employeeId);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: User_Access.php");
            $_SESSION['Success'] = 'Password Successfully Update';
        } else {
            $_SESSION['Error']= 'Password not update';  
            header("Location: User_Access.php");
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Query preparation failed.');</script>";
    }
}


?>

<?php includeFileWithVariables('layouts/title-meta.php', ['title' => 'Add Employee']); ?>
<?php include 'layouts/head-css.php'; ?>

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
                                            <a class="btn btn-success mb-3" href="User_Access.php"><i class="fa-solid fa-arrow-left"></i> Back</a>
                                            <form method="POST">
                                                <div class="row">
                                                    <!-- Employee Dropdown -->
                                                    <div class="col-md-6 mb-3">
                                                        <label>Employee Name</label>
                                                        <select name="Employeename" id="employeeDropdown" class="form-control" required onchange="fetchEmployeeDetails(this.value)">
                                                            <option value="">Select Employee</option>
                                                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                                                <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['fullname']) ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Branch Name</label>
                                                        <input type="text" name="Branchname" id="branch" class="form-control" required>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Department Name</label>
                                                        <input type="text" name="Department" id="department" class="form-control" required>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Designation</label>
                                                        <input type="text" name="Designation" id="designation" class="form-control" required>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Username (Employee Email)</label>
                                                        <input type="text" name="Username" id="email" class="form-control" required>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Password</label>
                                                        <input type="text" name="Password" class="form-control" required>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-primary mt-3">Confirm</button>
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

    <!-- JavaScript to fetch employee details using AJAX -->
    <script>
        function fetchEmployeeDetails(employeeId) {
            if (employeeId === "") return;

            fetch('get_employee_data.php?id=' + employeeId)
                .then(response => response.json())
                .then(data => {
                    // Fill the fields with data
                    document.getElementById('branch').value = data.branch || '';
                    document.getElementById('department').value = data.department || '';
                    document.getElementById('designation').value = data.designation || '';
                    document.getElementById('email').value = data.email || '';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to fetch employee data.');
                });
        }
    </script>

</body>

</html>