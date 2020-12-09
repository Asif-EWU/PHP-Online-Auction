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

<style>
    
</style>
<body>
    <div class="bg-image">
        <div class="overlay">
            <div class="container">
                <div class="log-in">
                    
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="text" name="email" placeholder="Email" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <input class="btn btn-primary" type="submit" name="submit" value="Sign In">
                    </form>

                    <p class="register">Don't have an account? <a href="register.php">Register to bid</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>