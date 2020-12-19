<?php
    session_start();
    include("../includes/database.php");

    if(isset($_POST['logout'])) {
        session_destroy();
        if(isset($_COOKIE["logout"])) setcookie("logout", 1, time() + (3600 * 24 * 30), "/");
        header("Refresh:0; url=../index.php");
    }
    
    if(isset($_POST['editProfile'])) header('Refresh:0; url=user_profile_edit.php');
    if(isset($_POST['changePassword'])) header('Refresh:0; url=user_change_password.php');

    $id = $_SESSION['id'];
    $query = "SELECT * FROM user WHERE id = '$id' ";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Bootstrap</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="request_auction.php">Request Auction</a></li>
        <li><a href="#">Messages</a></li>
        <li><a href="user_profile.php">Profile</a></li>
        <li>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input class="btn btn-link" type="submit" name="logout" value="Logout">
            </form>
        </li>
    </ul>

    <div class="container">
        <br><h1 class="text-center">PROFILE</h1><br>

        <ul class="list-group">
            <li class="list-group-item">ID            : <?php echo $row['id'] ?> </li>
            <li class="list-group-item">Name          : <?php echo $row['name'] ?> </li>
            <li class="list-group-item">Email         : <?php echo $row['email'] ?> </li>
            <li class="list-group-item">City          : <?php echo $row['city'] ?> </li>
            <li class="list-group-item">Country       : <?php echo $row['country'] ?> </li>
            <li class="list-group-item">Country Code  : <?php echo $row['country_code'] ?> </li>
            <li class="list-group-item">Gender        : <?php echo $row['gender'] ?> </li>
            <li class="list-group-item">Date of Birth : <?php echo $row['dob'] ?> </li>
            <li class="list-group-item">Age           : <?php echo $row['age'] ?> </li>
            <li class="list-group-item">Address       : <?php echo $row['address'] ?> </li>
        </ul>

        <br><br>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
           <button class="btn btn-primary" name="editProfile">Edit Profile</button>
           <button class="btn btn-primary" name="changePassword">Change Password</button>
       </form>
    </div>
</body>
</html>
