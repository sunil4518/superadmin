<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
<?php include 'config.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $departmentname = $_POST['departmentname'];
    $branchname = $_POST['branchname'];


    $res = "INSERT INTO department(departmentname,branchname)VALUES('$departmentname','$branchname')";
    if (mysqli_query($link, $res)) {
        $_SESSION['success'] = 'Branch Insert Successfully';
        header('Location: Department.php');
    } else {
        echo 'error';
    }
}
?>


<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Team')); ?>
    <?php include 'layouts/head-css.php'; ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
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
                                                <a class="btn btn-success" href="Department.php"><i
                                                        class="fa-solid fa-arrow-left"></i> Back</a>
                                                <div id="example_filter" class="dataTables_filter"></div>
                                            </div>
                                            <form method="POST">

                                                <div class="mb-3">
                                                    <label for="branchname" class="form-label">Department Name</label>
                                                    <input type="text" name="departmentname" id="departmentname"
                                                        class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="branchname" class="form-label">Branch Name</label>
                                                    <select name="branchname" id="branchname" class="form-control"
                                                        required>
                                                        <option value="">Select Branch</option>
                                                        <?php
                                                        include 'config.php';
                                                        $query = "SELECT * FROM branch";
                                                        $result = mysqli_query($link, $query);
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo "<option value='" . $row['branchname'] . "'>" . $row['branchname'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Create</button>
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
    <script src="assets/js/pages/team.init.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>