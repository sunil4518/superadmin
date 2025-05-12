<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
<?php include 'config.php'; ?>

<?php
if (isset($_POST['submit'])) {
    $coupan = $_POST['coupan'];
    $service = $_POST['service'];
    $amount = $_POST['amount'];
    $status = $_POST['status'];

    $query = "INSERT INTO coupan (coupan, service, amount, status) VALUES ('$coupan', '$service', '$amount', '$status')";
    mysqli_query($link, $query);
    header("Location: Coupan.php");
    exit();
}
?>

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Add Coupan')); ?>
    <?php include 'layouts/head-css.php'; ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        .form-section {
            background-color: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .form-section h4 {
            margin-bottom: 25px;
            font-weight: bold;
        }

        .form-control,
        .form-select {
            border-radius: 0.5rem;
        }
    </style>
</head>

<body>
    <div id="layout-wrapper">
        <?php include 'layouts/menu.php'; ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="form-section mt-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <a href="Coupan.php" class="btn btn-success"><i class="fa fa-arrow-left"></i>
                                        Back</a>
                                </div>
                                <form method="POST">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Coupan Code</label>
                                            <input type="text" name="coupan" class="form-control"
                                                placeholder="Enter coupan code" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Service</label>
                                            <input type="text" name="service" class="form-control"
                                                placeholder="Enter service name" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Amount</label>
                                            <input type="number" name="amount" class="form-control"
                                                placeholder="Enter amount" step="0.01" required>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-select">
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-primary">Add Coupan</button>


                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <?php include 'layouts/footer.php'; ?>
        </div>
    </div>

    <?php include 'layouts/vendor-scripts.php'; ?>
    <script src="assets/js/app.js"></script>
</body>

</html>