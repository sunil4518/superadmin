<?php
include 'layouts/session.php';
include 'layouts/main.php';
include 'config.php';

// Fetch employees for dropdown
$query = "SELECT id, fullname FROM employees";
$result = mysqli_query($link, $query);

// Check if form is submitted for updating
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $employeeId = $_POST['Employeename'];
    $branch = $_POST['Branchname'];
    $department = $_POST['Department'];
    $designation = $_POST['Designation'];
    $email = $_POST['Username'];
    $password = $_POST['Password'];

    // If password is provided, update it
    if (!empty($password)) {
        // Use password hashing for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Update query for password and other details
        $updateQuery = "UPDATE employees SET branch = ?, department = ?, designation = ?, email = ?, password = ? WHERE id = ?";
        $stmt = mysqli_prepare($link, $updateQuery);
        mysqli_stmt_bind_param($stmt, "sssssi", $branch, $department, $designation, $email, $hashedPassword, $employeeId);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Employee data updated successfully');</script>";
        } else {
            echo "<script>alert('Failed to update employee data');</script>";
        }
    } else {
        // If password is not provided, only update other details
        $updateQuery = "UPDATE employees SET branch = ?, department = ?, designation = ?, email = ? WHERE id = ?";
        $stmt = mysqli_prepare($link, $updateQuery);
        mysqli_stmt_bind_param($stmt, "ssssi", $branch, $department, $designation, $email, $employeeId);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Employee details updated successfully');</script>";
        } else {
            echo "<script>alert('Failed to update employee details');</script>";
        }
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
                                                    <div class="col-md-6 mb-3">
                                                        <label>Employee Name</label>
                                                        <input type="text" name="Employeename" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Branch Name</label>
                                                        <input type="text" name="Branchname" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Department Name</label>
                                                        <input type="text" name="Department" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Designation</label>
                                                        <input type="text" name="Designation" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Username</label>
                                                        <input type="text" name="Username" class="form-control" required>
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
</body>

</html>