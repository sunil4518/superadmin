<?php
include 'config.php';

if (isset($_GET['id'])) {
    $employeeId = intval($_GET['id']);

    $query = "SELECT email, branch, department, designation FROM employees WHERE id = $employeeId";
    $result = mysqli_query($link, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        echo json_encode([
            'email' => $data['email'],
            'branch' => $data['branch'],
            'department' => $data['department'],
            'designation' => $data['designation']
        ]);
    } else {
        echo json_encode(['error' => 'Employee not found']);
    }
} else {
    echo json_encode(['error' => 'Employee ID is missing']);
}
?>
