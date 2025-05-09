<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
<?php include 'config.php'; ?>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $branchname = $_POST['branchname'];
    $branchcode = $_POST['branchcode'];
    $branchaddress = $_POST['branchaddress'];

    $res = "INSERT INTO branch(branchname,branchcode,branchaddress)VALUES('$branchname','$branchcode','$branchaddress')";
    if(mysqli_query($link, $res)){
        $_SESSION['success'] = 'Branch Insert Successfully';
        header('Location: Branch.php');
    }
    else{ 
        echo'error';
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
                                                <a class="btn btn-success" href="Branch.php"><i
                                                        class="fa-solid fa-arrow-left"></i> Back</a>
                                                <div id="example_filter" class="dataTables_filter"></div>
                                            </div>
                                            <form method="POST">
                                                <div class="mb-3">
                                                    <label for="branchname" class="form-label">Branch Name</label>
                                                    <input type="text" name="branchname" id="branchname"
                                                        class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="branchcode" class="form-label">Branch Code</label>
                                                    <input type="text" name="branchcode" id="branchcode"
                                                        class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="branchaddress" class="form-label">Branch Address</label>
                                                    <input type="text" name="branchaddress" id="branchaddress"
                                                        class="form-control">
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