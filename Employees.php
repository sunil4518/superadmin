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
                                                    <a class="btn btn-success" href="Add_Employees.php">Add New Employee</a>
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
                                                        <th>Name</th>
                                                        <th>Mobile</th>
                                                        <th>Designation</th>
                                                        <th>Branch</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = "SELECT 
                                                    employees.id,
                                                    employees.fullname,
                                                    employees.number,
                                                    employees.designation,
                                                    employees.branch,
                                                    employees.status
                                                FROM employees";
                                                    $result = mysqli_query($link, $query);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($data = mysqli_fetch_assoc($result)) {
                                                            $statusClass = $data['status'] === 'Active' ? 'btn-success' : 'btn-warning';
                                                            echo "<tr>
                                                            <td>{$data['id']}</td>
                                                            <td>{$data['fullname']}</td>
                                                            <td>{$data['number']}</td>
                                                            <td>{$data['designation']}</td>
                                                            <td>{$data['branch']}</td>
                                                            <td>
                                                                <button class='btn btn-sm $statusClass toggle-status' data-id='{$data['id']}'>{$data['status']}</button>
                                                                <button class='btn btn-danger btn-sm delete-employee' data-id='{$data['id']}'>Delete</button>
                                                            </td>
                                                        </tr>";
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='6'>No employees found.</td></tr>";
                                                    }
                                                    ?>
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
        $(document).ready(function() {
            const table = $('#example').DataTable({
                dom: 'frtip',
                lengthChange: false,
                pageLength: 10,
                responsive: true
            });

            // Move search box
            $('#custom-search').html($('#example_filter').html());
            $('#example_filter').remove();

            // Remove "Search:" label text
            $('#custom-search label').contents().filter(function() {
                return this.nodeType === 3;
            }).remove();

            // Update placeholder
            $('#custom-search input').attr('placeholder', 'Search Employees...');

            // Search functionality
            $('#custom-search input').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Toggle status functionality
            $(document).on('click', '.toggle-status', function() {
                const button = $(this),
                    id = button.data('id');
                $.post('toggle_status.php', {
                    id
                }, function(response) {
                    if (response === 'Active') {
                        button.removeClass('btn-warning').addClass('btn-success').text('Active');
                    } else if (response === 'InActive') {
                        button.removeClass('btn-success').addClass('btn-warning').text('InActive');
                    } else {
                        alert('Failed to update status');
                    }
                });
            });

            // Delete employee functionality
            $(document).on('click', '.delete-employee', function() {
                const button = $(this),
                    id = button.data('id');
                if (confirm('Are you sure you want to delete this employee?')) {
                    $.post('delete_employee.php', {
                        id
                    }, function(response) {
                        if (response.trim() === 'success') {
                            button.closest('tr').remove();
                        } else {
                            alert('Failed to delete employee');
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>