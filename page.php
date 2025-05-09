<?php
include 'layouts/session.php';
include 'layouts/main.php';
include 'config.php';

$id = $_SESSION['id'];

if (isset($_POST['update_profile'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $zipcode = $_POST['zipcode'];

    // Handle profile image
    $profile = '';
    if (isset($_FILES['profile']) && $_FILES['profile']['error'] == 0) {
        $target_dir = "uploads/"; // folder where image will be stored
        $profile = basename($_FILES["profile"]["name"]);
        $target_file = $target_dir . $profile;

        // You can add validation here (e.g., check file type/size)
        if (move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file)) {
            // Successfully uploaded
        } else {
            // Error uploading
            $_SESSION['error_message'] = "Error uploading the image!";
            header("Location: pages-profile-settings.php");
            exit;
        }
    }

    // Update query with profile image if uploaded
    $update_query = "UPDATE company_users SET 
                         name = '$name', 
                         Phone_Number = '$phone', 
                         email = '$email', 
                         city = '$city', 
                         Country = '$country', 
                         Zip_Code = '$zipcode'";

    if (!empty($profile)) {
        $update_query .= ", profile = '$profile'";
    }

    $update_query .= " WHERE id = $id";

    if (mysqli_query($link, $update_query)) {
        $_SESSION['success_message'] = "Profile Updated Successfully!";
        header("Location: pages-profile-settings.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Something Went Wrong!";
        header("Location: pages-profile-settings.php");
        exit;
    }
}
?>
