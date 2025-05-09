<?php
include 'config.php';

if (isset($_GET['emp_id'])) {
    $emp_id = $_GET['emp_id'];
    $query = "
        SELECT 
            e.email, e.branch AS branch_id, e.department AS department_id, e.designation AS designation_id,
            b.branch_name, d.department_name, des.designation_name
        FROM employees e
        LEFT JOIN branch b ON b.branch_id = e.branch
        LEFT JOIN department d ON d.department_id = e.department
        LEFT JOIN designation des ON des.designation_id = e.designation
        WHERE e.id = '$emp_id'
    ";

    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode([
            'success' => true,
            'email' => $row['email'],
            'branch' => $row['branch_name'],
            'department' => $row['department_name'],
            'designation' => $row['designation_name']
        ]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
