<?php 
    include("includes/database.php");
    session_start();

    $loginErr = "";

    if(isset($_POST['submit'])) {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        $query = "SELECT * 
            FROM user 
            WHERE (email = '$email' AND password = '$password') ";
        
        $result = mysqli_query($conn, $query);
        if(!mysqli_num_rows($result)) {
            $loginErr = "Invalid email or password !!  Try again";
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
    <div class="bg-image">
        <div class="overlay">
            <div class="container">
                <div class="log-in">
                    <img src="images/auction.png" alt=""> 
                    
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="text" name="email" placeholder="Email" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <input class="btn btn-primary" type="submit" name="submit" value="Sign In">
                    </form>

                    <?php 
                        if($loginErr) {
                            echo '<div class="invalid-alert text-danger" role="alert">';
                            echo $loginErr;
                            echo '</div>';
                        }
                    ?>

                    <p class="register">Don't have an account? <a href="register.php">Register to bid</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>