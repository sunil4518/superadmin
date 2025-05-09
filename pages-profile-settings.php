<style>
    #alertMessage {
        text-align: center;
    }
</style>
<?php
include 'layouts/session.php';
include 'layouts/main.php';
include 'config.php';
$id = $_SESSION['id'];

$res = mysqli_query($link, "SELECT * FROM company_users WHERE id = $id");
$data = mysqli_fetch_assoc($res);
?>

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', ['title' => 'Profile Settings']); ?>
    <?php include 'layouts/head-css.php'; ?>
</head>

<body>
    <div id="layout-wrapper">
        <?php include 'layouts/menu.php'; ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="position-relative mx-n4 mt-n4">
                        <div class="overlay-content">
                            <div class="text-end p-3">
                                <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                                    <input id="profile-foreground-img-file-input" type="file" class="profile-foreground-img-file-input">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <form action="page.php" method="POST" enctype="multipart/form-data">

                            <div class="col-xxl-3">
                                <div class="card mt-n5">
                                    <div class="card-body p-4 text-center">
                                        <div class="profile-user position-relative d-inline-block mx-auto mb-4">
                                            <img src="uploads/<?php echo !empty($data['profile']) ? $data['profile'] : 'default.jpg'; ?>"
                                                class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow"
                                                alt="user-profile-image">

                                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                <input id="profile-img-file-input" name="profile" type="file" class="profile-img-file-input" accept="image/*">
                                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light text-body material-shadow">
                                                        <i class="ri-camera-fill"></i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <h5 class="fs-16 mb-1"><?php echo $data['name']; ?></h5>
                                        <p class="text-muted mb-0"><?php echo $data['role']; ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-9">
                                <div class="card mt-xxl-n5">
                                    <div class="card-header">
                                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                                    <i class="fas fa-home"></i> Personal Details
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                                    <i class="far fa-user"></i> Change Password
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="card-body p-4">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="personalDetails" role="tabpanel">

                                                <div class="row">
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Full Name</label>
                                                        <input type="text" class="form-control" name="name" value="<?php echo $data['name']; ?>" placeholder="Enter your Full Name">
                                                    </div>
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Phone Number</label>
                                                        <input type="text" class="form-control" name="phone" value="<?php echo $data['Phone_Number']; ?>" placeholder="Enter your phone number">
                                                    </div>
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Email Address</label>
                                                        <input type="email" class="form-control" name="email" value="<?php echo $data['email']; ?>" placeholder="Enter your email">
                                                    </div>
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">City</label>
                                                        <input type="text" class="form-control" name="city" value="<?php echo $data['city']; ?>" placeholder="City">
                                                    </div>
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Country</label>
                                                        <input type="text" class="form-control" name="country" value="<?php echo $data['Country']; ?>" placeholder="Country">
                                                    </div>
                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label">Zip Code</label>
                                                        <input type="text" class="form-control" name="zipcode" value="<?php echo $data['Zip_Code']; ?>" minlength="5" maxlength="6" placeholder="Enter zipcode">
                                                    </div>
                                                    <div class="col-lg-12 text-end">
                                                        <?php
                                                        if (isset($_SESSION['success_message'])) {
                                                            echo '<div id="alertMessage" class="alert alert-success custom-alert">' . $_SESSION['success_message'] . '</div>';
                                                            unset($_SESSION['success_message']);
                                                        }

                                                        if (isset($_SESSION['error_message'])) {
                                                            echo '<div id="alertMessage" class="alert alert-danger custom-alert" >' . $_SESSION['error_message'] . '</div>';
                                                            unset($_SESSION['error_message']);
                                                        }
                                                        ?>
                                                        <button type="submit" name="update_profile" class="btn btn-primary">Update</button>
                                                        <button type="reset" class="btn btn-soft-success">Cancel</button>
                                                    </div>
                                                </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="changePassword" role="tabpanel">
                        <form action="old_change_password.php" method="POST">
                            <div class="row g-2">
                                <div class="col-lg-4">
                                    <label class="form-label">Old Password*</label>
                                    <input type="password" class="form-control" name="old_password" placeholder="Enter current password">
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">New Password*</label>
                                    <input type="password" class="form-control" name="new_password" placeholder="Enter new password">
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Confirm Password*</label>
                                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm password">
                                </div>
                                <div class="col-lg-12 text-end mt-3">
                                    <?php
                                    if (isset($_SESSION['Password_success_message'])) {
                                        echo '<div id="alertMessage" class="alert alert-success custom-alert" style="text-align:center;">' . $_SESSION['Password_success_message'] . '</div>';
                                        unset($_SESSION['Password_success_message']);
                                    }

                                    if (isset($_SESSION['Password_error_message'])) {
                                        echo '<div id="alertMessage" class="alert alert-danger custom-alert" style="text-align:center;>' . $_SESSION['Password_error_message'] . '</div>';
                                        unset($_SESSION['Password_error_message']);
                                    }
                                    if (isset($_SESSION['Password_Not_Match'])) {
                                        echo '<div id="alertMessage" class="alert alert-danger custom-alert" style="text-align:center;>' . $_SESSION['Password_Not_Match'] . '</div>';
                                        unset($_SESSION['Password_Not_Match']);
                                    }
                                    if (isset($_SESSION['OldPassword_Not_Match'])) {
                                        echo '<div id="alertMessage" class="alert alert-danger custom-alert" style="text-align:center;>' . $_SESSION['OldPassword_Not_Match'] . '</div>';
                                        unset($_SESSION['OldPassword_Not_Match']);
                                    }
                                    ?>
                                    <button type="submit" name="change_password" class="btn btn-success">Change Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <?php include 'layouts/footer.php'; ?>
    </div>
    </div>
    <?php include 'layouts/customizer.php'; ?>
    <?php include 'layouts/vendor-scripts.php'; ?>
    <script src="assets/js/pages/profile-setting.init.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>