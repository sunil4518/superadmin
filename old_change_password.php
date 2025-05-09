<?php
include 'layouts/session.php';
include 'layouts/main.php';
include 'config.php';

$id = $_SESSION['id'];

if (isset($_POST['change_password'])) {
    $old_password = mysqli_real_escape_string($link, $_POST['old_password']);
    $new_password = mysqli_real_escape_string($link, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($link, $_POST['confirm_password']);

    if (empty($old_password) || empty($new_password) || empty($confirm_password)) {
        header("Location: pages-profile-settings.php#changePassword");
        $_SESSION['OldPassword_Not_Match'] = "Please Fill All The Details";
        exit;
    }

    if ($new_password !== $confirm_password) {
        header("Location: pages-profile-settings.php#changePassword");
        $_SESSION['Password_Not_Match'] = "New And Confirm Password Does Not Match";
        exit;
    }

    $stmt = mysqli_prepare($link, "SELECT password FROM company_users WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hashed_password);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($hashed_password && password_verify($old_password, $hashed_password)) {
        $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);

        $update_stmt = mysqli_prepare($link, "UPDATE company_users SET password = ? WHERE id = ?");
        mysqli_stmt_bind_param($update_stmt, "si", $new_password_hashed, $id);
        $update_success = mysqli_stmt_execute($update_stmt);
        mysqli_stmt_close($update_stmt);

        if ($update_success) {
            header("Location: pages-profile-settings.php#changePassword");
            $_SESSION['Password_success_message'] = "Password Update Sucessfully!";
            exit;
        } else {
            $_SESSION['Password_error_message'] = " Something Went Wrong!";
            exit;
        }
    } else {
        header("Location: pages-profile-settings.php#changePassword");
        $_SESSION['OldPassword_Not_Match'] = "Old Password Not Match";
        exit;
    }
}
?>
