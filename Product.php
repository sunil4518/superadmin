<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
<?php include 'config.php'; ?>

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Products')); ?>
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

        .search-wrapper {
            display: flex;
            max-width: 250px;
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

            .top-bar > div {
                width: 100%;
                justify-content: center;
                margin-bottom: 10px;
            }

            .search-wrapper {
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
    <div class="d-flex gap-2 flex-wrap">
        <a class="btn btn-success" href="Add_Product.php">Add New Product</a>
        <a class="btn btn-success" href="Add_Combo.php">Add Combo</a> <!-- Replace with actual page -->
    </div>
    <div class="search-wrapper" id="custom-search"></div>
</div>

                                            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>S.No.</th>
                                                        <th>Service Name</th>
                                                        <th>Service Amount</th>
                                                        <th>Service Type</th>
                                                
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $res = "SELECT * FROM product";
                                                    $product = mysqli_query($link, $res);
                                                    $sno = 1;
                                                    while ($data = mysqli_fetch_assoc($product)):
                                                        $statusClass = $data['status'] === 'Active' ? 'btn-success' : 'btn-warning';
                                                    ?>
                                                        <tr id="row-<?= $data['id']; ?>">
                                                            <td><?= $sno++; ?></td>
                                                            <td><?= $data['service']; ?></td>
                                                            <td><?= $data['amount']; ?></td>
                                                            <td><?= $data['service_type']; ?></td>
                                                        
                                                            <td>
                                                                 <button class="btn btn-sm <?= $statusClass ?> toggle-status" data-id="<?= $data['id']; ?>">
                                                                    <?= $data['status']; ?>
                                                                </button>
                                                                <a href="delete-product.php?id=<?= $data['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">
                                                                    Delete
                                                                </a>
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
            $('#custom-search input').attr('placeholder', 'Search Product...');

            // Status toggle
            $(document).on('click', '.toggle-status', function () {
                const button = $(this);
                const id = button.data('id');

                $.post('toggle-product-status.php', { id }, function (response) {
                    if (response === 'Active') {
                        button.removeClass('btn-warning').addClass('btn-success').text('Active');
                    } else if (response === 'Inactive') {
                        button.removeClass('btn-success').addClass('btn-warning').text('Inactive');
                    } else {
                        alert('Failed to update status');
                    }
                });
            });
        });
    </script>
</body>
</html>
