<?php 
    include("includes/database.php");
    session_start();

    $loginErr = "";

    if(isset($_POST['submit'])) {
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "SELECT * 
            FROM user 
            WHERE email = '$email' ";
        
        $result = mysqli_query($db, $query);
        if(!mysqli_num_rows($result)) {
            $loginErr = "Invalid email or password !!  Try again";
        }
        else {
            $row = mysqli_fetch_array($result);
            $dbPassword = $row["password"];
            
            if(password_verify($password, $dbPassword)) {
                header("Refresh:0; url=user/user_home.php");
            }
            else {
                $loginErr = "Invalid email or password !! Try again";
            }                
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <title>Auction</title>
</head>
<body>
    <img class="bg-image" src="images/judge.jpg" alt="">
    <div class="dark-overlay"></div>

    <div class="container">
        <div class="log-in">
            <img src="images/auction.png" alt=""> 
            
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input class="form-control" type="text" name="email" placeholder="Email" required>
                <input class="form-control" type="password" name="password" placeholder="Password" required>
                <input class="btn btn-primary" type="submit" name="submit" value="Sign In">
            </form>

            <?php 
                if($loginErr) {
                    echo '<div class="invalid-alert text-danger" role="alert">';
                    echo $loginErr;
                    echo '</div>';
                }
            ?>

            <p class="register">Don't have an account? <a href="register.php">Register First</a></p>
        </div>
    </div>
</body>
</html>