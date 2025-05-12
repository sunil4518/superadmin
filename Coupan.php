<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Team')); ?>
    <?php include 'layouts/head-css.php'; ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <style>
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .top-bar .left {
            display: flex;
            justify-content: flex-start;
        }

        .top-bar .right {
            display: flex;
            justify-content: flex-end;
        }

        .search-wrapper {
            display: flex;
            width: 100%;
            max-width: 250px;
        }

        .search-wrapper label {
            margin: 0;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .search-wrapper input[type="search"] {
            height: 38px;
            padding: 6px 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            width: 100%;
        }

        @media screen and (max-width: 768px) {
            .top-bar {
                flex-direction: column;
                align-items: center;
            }

            .top-bar .left,
            .top-bar .right {
                width: 100%;
                justify-content: center;
                margin-bottom: 10px;
            }

            .top-bar .left .btn,
            .search-wrapper {
                width: 100%;
                max-width: none;
            }
        }
    </style>
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
                                <div class="col-12">
                                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                                        <div class="card-body p-4 p-md-5 form-container">
                                            <div class="top-bar">
                                                <div class="left">
                                                    <a class="btn btn-success" href="Add_Coupan.php">Add Coupan</a>
                                                </div>
                                                <div class="right">
                                                    <div class="search-wrapper" id="custom-search"></div>
                                                </div>
                                            </div>
                                            <table id="example" class="table table-striped table-bordered"
                                                cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>S.No.</th>
                                                        <th>Coupan</th>
                                                        <th>Service</th>
                                                        <th>Amount</th>

                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    include 'config.php';
                                                    $res = "SELECT * FROM coupan";
                                                    $branch = mysqli_query($link, $res);
                                                    $sno = 1;
                                                    while ($data = mysqli_fetch_assoc($branch)):
                                                        $statusClass = $data['status'] === 'Active' ? 'btn-success' : 'btn-warning';
                                                        ?>
                                                        <tr>
                                                            <td><?= $sno++; ?></td>
                                                            <td><?= $data['coupan']; ?></td>
                                                            <td><?= $data['service']; ?></td>
                                                            <td><?= $data['amount']; ?></td>

                                                            <td>
                                                                <a href="coupan-toggle.php?id=<?= $data['id']; ?>"
                                                                    class="btn btn-sm <?= $statusClass ?>">
                                                                    <?= $data['status']; ?>
                                                                </a>
                                                                <a href="delete-coupan.php?id=<?= $data['id']; ?>"
                                                                    class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Are you sure?');">Delete</a>
                                                            </td>
                                                        </tr>
                                                    <?php endwhile; ?>

                                                </tbody>

                                            </table>
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
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
        $(document).ready(function () {
            let table = $('#example').DataTable({
                dom: 'frtip',
                lengthChange: false,
                pageLength: 10,
                responsive: true
            });
            $('#custom-search').html($('#example_filter').html());
            $('#example_filter').remove();
            $('#custom-search label').contents().filter(function () {
                return this.nodeType === 3;
            }).remove();
            $('#custom-search input').attr('placeholder', 'Search Coupan...');
            $('#custom-search input').on('keyup', function () {
                table.search(this.value).draw();
            });
        });

    </script>
    <script>
        function toggleStatus(id) {
            fetch('coupan-troggle.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'id=' + id
            })
                .then(response => response.text())
                .then(data => {
                    alert("Status changed to: " + data);
                    location.reload(); // optional: reload to reflect changes
                });
        }
    </script>
</body>

</html>