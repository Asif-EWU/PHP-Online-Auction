<?php 
    session_start();
    require_once("../includes/database.php");
    $id = $_SESSION['id'];
    
    $countErr = 0;
    $currentPasswordErr = $newPasswordErr = $confirmNewPasswordErr = $status = "";

    if(isset($_POST['update'])) {
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmNewPassword = $_POST['confirmNewPassword'];

        $query = "SELECT * FROM admin WHERE id='$id' "; 
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_array($result);
        $dbPassword = $row['password'];

        if(! password_verify($currentPassword, $dbPassword)) {
            $currentPasswordErr = "Current password doesn't match";
            $countErr++;
        }
        if($currentPassword === $newPassword) {
            $newPasswordErr = "New Password Can Not Be Old Password";
            $countErr++;
        }
        if($newPassword !== $confirmNewPassword) {
            $confirmNewPasswordErr = "Doesn't match with new password";
            $countErr++;
        }

        if(! $countErr) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $query = "UPDATE user SET password='$hashedPassword' WHERE id='$id' ";
            if(mysqli_query($db, $query)) $status = "<p class='alert alert-success'>Password Changed Successfully !!</p>";
            else $status = "<p class='alert alert-danger'>Couldn't Change Password !!</p>";

            header("Refresh:1; url=admin_profile.php");
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>
<style>
    .pink {color: red;}
</style>
<body>
    <?php include('../includes/admin_navbar.php'); ?>    

    <div class="container mt-5">
        <?php echo $status; ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group row">
                <label for="currentPassword" class="col-sm-3 col-form-label">Current Password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="currentPassword" id="currentPassword" required>
                    <span class="pink"><?php echo $currentPasswordErr; ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="newPassword" class="col-sm-3 col-form-label">New Password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="newPassword" id="newPassword" required>
                    <span class="pink"><?php echo $newPasswordErr; ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="confirmNewPassword" class="col-sm-3 col-form-label">Confirm New Password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="confirmNewPassword" id="confirmNewPassword" required>
                    <span class="pink"><?php echo $confirmNewPasswordErr; ?></span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-9">
                    <button type="submit" name="update" class="btn btn-primary mt-3">Update</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>